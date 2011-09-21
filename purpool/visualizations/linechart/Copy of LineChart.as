package{
	import flash.net.*;
	import flash.events.*;
	import flash.text.*;
	import flash.display.MovieClip;
	import flash.geom.Point;
	import flash.display.*;
	import flash.xml.XMLNode;
	import flash.xml.XMLDocument;
	import flash.display.Loader;
	import fl.controls.*;
	import fl.events.*;
	import flash.system.Security;

	
	
	public class LineChart extends MovieClip{
		private var _grid:Grid;
		private var _numOfDisplayedDataPoints=8;
		private var _gridDensity;
		private var _xmlLoader:URLLoader;
		private var _xmlDataLoader: URLLoader;
		private var _previousSliderValue:int;
		private var _leftMargin:Number = 0;
		private var _graphHeight:Number = 160;
		private var _startingStackX:Number;
		private var _timeLineTrack:TimeLineTrack;
		private var _summary:WeeklySummary;
		private var _comboBox:ComboBox;
		private var _poolAttributes:Array;
		private var _gasSavings, _milesNotDriven, _carsOffRoad, _CO2Savings:Array;
		private var _linePlot:LinePlot;
		private var _largest, _ave: Object;
		private var _hScrollBar:UIScrollBar;
		private var _maxField, _aveField:TextField ;
		private var _firstTimeInHandler:Boolean = true; // needed to check whether scrollbar handler has been invoked at startup for noa pparent reason
		public function LineChart(){
			//System.security.allowDomain("http://www.purpool.com");
			//Security.loadPolicyFile("xmlsocket://purpool.com:80"); 

			var request:URLRequest = new URLRequest("http://www.purpool.com/linechart.php");
			//var request:URLRequest = new URLRequest("savings.xml");
			_xmlDataLoader = new URLLoader(request);
			_xmlDataLoader.addEventListener("complete", onXMLLoaded);
			

			_gasSavings = new Array();
			_milesNotDriven = new Array();
			_carsOffRoad = new Array() 
			_CO2Savings = new Array();
			
			_grid = new Grid(640,200);
			_grid.x=_leftMargin; _grid.y=30; _grid.width=640;
			addChild(_grid);
			//drawTitle("Savings");
			_gridDensity=_grid.width/_numOfDisplayedDataPoints;
			
			_linePlot = new LinePlot(["10/5-10/12","10/13-10/19"], _gridDensity, this);
			_linePlot.y=_grid.y;
			var graphMask:GraphMask = new GraphMask();
			var graphBackground:GraphMask = new GraphMask();
			graphMask.x=graphBackground.x=_leftMargin; graphMask.y=graphBackground.y=_grid.y;graphMask.width=graphBackground.width=_grid.width; graphMask.height=graphBackground.height=_grid.height
			addChild(graphBackground);
			addChild(graphMask);
			_linePlot.mask = graphMask;
			_linePlot.x= _leftMargin;
			addChild(_linePlot);
			
			setupComboBox();
			 
			_hScrollBar = new UIScrollBar();
			_hScrollBar.direction = ScrollBarDirection.HORIZONTAL;
			_hScrollBar.move(_grid.x, _grid.y + _grid.height + 4);
			_hScrollBar.width = _grid.width;
			_hScrollBar.height = 14;
			addChild(_hScrollBar);
			
			_summary = new WeeklySummary();
			_summary.x = _grid.x;
			_summary.y = _hScrollBar.y + _hScrollBar.height + 30;
			//addChild(_summary);
		
		}
		private function scrollHandler(event:ScrollEvent):void {
			
			//for some reason handler is called without user input - without this the scrollbar is reset where position is 0
			if(_firstTimeInHandler){
				_hScrollBar.scrollPosition = _hScrollBar.maxScrollPosition ;
				_firstTimeInHandler = false;
			}
			else{
				_linePlot.x -= event.delta;
			}
			
		}
		private function onXMLLoaded(e:Event):void {
			var xml:XML = new XML(_xmlDataLoader.data);
			var weekList:XMLList = XMLList(xml.week);
			var item:XML;
			_poolAttributes = new Array();
			for each (item in weekList) {
				_gasSavings.push(Number(item.savings_in_gas));
				_milesNotDriven.push(Number(item.miles_not_driven));
				_carsOffRoad.push(Number(item.cars_off_the_road));
				_CO2Savings.push(Number(item.savings_in_co2));
				
				_poolAttributes.push({savingsInGas:item.savings_in_gas, milesNotDriven:item.miles_not_driven, carsOffRoad:item.cars_off_the_road, savingsInCO2:item.savings_in_co2, start:item.@start, end:item.@end});
			}
			
			//Week of October 1 - October 7, 2008
			var len = _poolAttributes.length;
			
	

			
			var i:int;
			_largest = new Object();
			_largest["savingsInGas"] = max(_gasSavings);
			_largest["milesNotDriven"] = max(_milesNotDriven);
			_largest["carsOffRoad"] = max(_carsOffRoad);
			_largest["savingsInCO2"] = max(_CO2Savings);
			_ave = new Object();;
			_ave["savingsInGas"] = mean(_gasSavings);
			_ave["milesNotDriven"] = mean(_milesNotDriven);
			_ave["carsOffRoad"] = mean(_carsOffRoad);
			_ave["savingsInCO2"] = mean(_CO2Savings);
			
			_linePlot.loadData(_poolAttributes, _summary)
			_linePlot.plot("savingsInGas", _poolAttributes, "10/05/2008", _largest, _ave, 160, 200);
			_linePlot.x =  _grid.width - (len-1)*_gridDensity + _leftMargin;
		 	_hScrollBar.minScrollPosition=0;  _hScrollBar.maxScrollPosition=(len-_numOfDisplayedDataPoints - 1)*_gridDensity;
			_hScrollBar.scrollPosition = _hScrollBar.maxScrollPosition ;
			_hScrollBar.addEventListener(ScrollEvent.SCROLL, scrollHandler);
		}


		public function drawTitle(title:String):void{
			var titleField:TextField = new TextField();

            titleField.width = 175;
            titleField.height = 30;
            titleField.y = 5;
			titleField.x = _grid.x;
           
			var format:TextFormat = new TextFormat();
            format.font = "Helvetica";
            format.bold = true;
            format.color = 0x6343BF;
            format.size = 16;
            titleField.defaultTextFormat = format;
			titleField.text = title;
            addChild(titleField);
		}
		public function drawYMarkings(maxHeight:Number,aveHeight:Number):void{
			var format:TextFormat = new TextFormat();
            format.font = "Arial";
            format.color = 0xFFFFFF;
            format.size = 9;
						
			try{
				removeChild(_maxField);
				removeChild(_aveField);
			}
			catch(errObject:Error){}	
			_maxField = new TextField();
			_aveField = new TextField();
			_maxField.background = true;
			_aveField.background = true;
			_maxField.backgroundColor = 0x7E7872;
			_aveField.backgroundColor = 0x7E7872;
			
			_maxField.width = _aveField.width = 23; 
			_maxField.height = _aveField.height = 12; 
			_maxField.x = _grid.x + 20; _maxField.y = maxHeight + _linePlot.y - 7;
			_aveField.x = _maxField.x; _aveField.y = aveHeight + _linePlot.y - 7;
			_maxField.defaultTextFormat = format;
			_maxField.text = String("MAX");
			_aveField.defaultTextFormat = format;
			_aveField.text = String("AVE");
				
			addChild(_maxField);
			addChild(_aveField);
			
		}

		private function setupComboBox():void {
			_comboBox = new ComboBox();
			_comboBox.focusEnabled = false;
            //_comboBox.prompt = "Select a Game";
            _comboBox.addItem( { label: "Gas savings", data:"savingsInGas" } );
            _comboBox.addItem( { label: "Miles not Driven", data:"milesNotDriven" } );
            _comboBox.addItem( { label: "Cars off the road", data:"carsOffRoad" } );
			_comboBox.addItem( { label: "GH emissions reduced", data:"savingsInCO2" } );
            _comboBox.addEventListener(Event.CHANGE, viewSelectedGraph); 
			_comboBox.width = 180;   
			_comboBox.x = _grid.x+_grid.width-_comboBox.width;
			_comboBox.y = _grid.y-_comboBox.height-5;
			

			addChild(_comboBox);
        }
		private function viewSelectedGraph(e:Event):void{
			_linePlot.plot(this._comboBox.selectedItem.data, _poolAttributes, "10/05/2008", _largest, _ave, 160, 200);
		}
		private function max(a:Array):Number{
			if(a.length>0){
				var largest:Number = a[0];
				var i:int;
				for(i=1; i<a.length; i++){
					if(a[i] > largest) largest = a[i];
				}
				return largest;
			}
			else{
				return -1;
			} 
		}
		private function mean(a:Array):Number{
			if(a.length>0){
				var tally=a[0];
				var i:int;
				for(i=1; i<a.length; i++){
					tally += a[i]
				}
				
				return tally/(a.length);
			}
			else{
				return -1;
			} 			
		}
	}


}
