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
	
	import StackPlot;
	
	public class StackChart extends MovieClip{
		private var _stack:StackPlot;
		private var _grid:Grid;
		private var _gridDensity;
		private var _numOfDisplayedDataPoints=8;
		private var _xmlLoader:URLLoader;
		private var _previousX:int;
		private var _horizontalScaleFactor:Number;
		private var _offset:int;
		private var _xmlDataLoader: URLLoader;
		private var _milesNotDriven:Array;
		private var _leftMargin:Number = 100;
		private var _stackHeight:Number = 360;
		private var _startingStackX:Number;

		private var _hScrollBar:UIScrollBar;
		private var _firstTimeInHandler:Boolean = true; // needed to check whether scrollbar handler has been invoked at startup for noa pparent reason
		var _output:TextField;
		public function StackChart(){
			var request:URLRequest = new URLRequest("stacked_chart.xml");
			
			_xmlDataLoader = new URLLoader(request);
			_xmlDataLoader.addEventListener("complete", onXMLLoaded);

			_grid = new Grid(600,400);
			
			_grid.x=_leftMargin; _grid.y=50; _grid.width=600;
			addChild(_grid);
			drawTitle("Miles Not Driven");
			_gridDensity=_grid.width/_numOfDisplayedDataPoints;
			_stack = new StackPlot( _gridDensity);
			_stack.y=50;
			var stackMask:StackMask = new StackMask();
			stackMask.x=_leftMargin; stackMask.y=50;stackMask.width=_grid.width; stackMask.height=_grid.height
			addChild(stackMask);
			_stack.mask = stackMask;
			addChild(_stack);
			
			_hScrollBar = new UIScrollBar();
			_hScrollBar.direction = ScrollBarDirection.HORIZONTAL;
			_hScrollBar.move(_grid.x, _grid.y + _grid.height + 10);
			_hScrollBar.width = _grid.width;
			addChild(_hScrollBar);
			/*_output = new TextField();
            _output.y = 460;
            _output.width = 300;
            _output.height = 50;
            _output.multiline = true;
            _output.wordWrap = true;
            _output.border = true;
            

            addChild(_output);*/
			
		}
		private function scrollHandler(event:ScrollEvent):void {
			
			//for some reason handler is called without user input - without this the scrollbar is reset where position is 0
			if(_firstTimeInHandler){
				_hScrollBar.scrollPosition = _hScrollBar.maxScrollPosition ;
				_firstTimeInHandler = false;
			}
			else{
				_stack.x -= event.delta;
			}
		}
	
		private function onXMLLoaded(e:Event):void {
			var xml:XML = new XML(_xmlDataLoader.data);
			var pools:XMLList = XMLList(xml.pool);
			var item:XML;
			var milesNotDriven:Array=new Array();
			var poolAttributes:Array= new Array();
			var weeks:Array = new Array();
			weeks = xml.weeks.split(',');
			//_output.appendText(weeks.length + " ");
			for each (item in pools) {
				milesNotDriven.push(item.miles_not_driven.split(','));
				poolAttributes.push({name:item.@name, members:item.@members, carsOffRoad:item.@cars_off_road, index:item.@index});
				//trace(item.@name + " " + item.@members + " " + item.@cars_off_road +  " " + milesNotDriven.length);
			}
			//_output.appendText(poolAttributes[0].index + " ");
			//calculate the max sum of y values in order to scale values to fit graph
			var i, pool, sum, max: int;
			max=0;
			for(i=0; i< milesNotDriven[0].length; i++){
				sum=0;
				for(pool=0; pool< milesNotDriven.length; pool++){
					sum += Number(milesNotDriven[pool][i]);
				}
				if(sum > max) max=sum;
			}
			
			//scale values
			for(pool=0; pool< milesNotDriven.length; pool++){
				for(i=0; i< milesNotDriven[0].length; i++){
					milesNotDriven[pool][i] = milesNotDriven[pool][i]*_stackHeight/max;
				}
			}	
			_stack.plot(poolAttributes, milesNotDriven, weeks);
			
			_stack.x =  _grid.width - _stack.width + _leftMargin;
			_startingStackX = _stack.x;
			
			drawYMarkings(max);
						
			_hScrollBar.minScrollPosition=0;  _hScrollBar.maxScrollPosition=(milesNotDriven[0].length - _numOfDisplayedDataPoints - 1)*_gridDensity;
			_hScrollBar.scrollPosition = _hScrollBar.maxScrollPosition ;
			_hScrollBar.addEventListener(ScrollEvent.SCROLL, scrollHandler);
		}
		public function drawTitle(title:String):void{
			var titleField:TextField = new TextField();

            titleField.width = 175;
            titleField.height = 30;
            titleField.y = 5;
			titleField.x = _grid.width/2 - titleField.width/2 + _leftMargin;
           
			var format:TextFormat = new TextFormat();
            format.font = "Verdana";
            format.color = 0x999999;
            format.size = 20;
            titleField.defaultTextFormat = format;
			titleField.text = title;
            addChild(titleField);
		}
		public function drawYMarkings(max:Number){
			var format:TextFormat = new TextFormat();
            format.font = "Verdana";
            format.color = 0x999999;
            format.size = 10;
			var tickMark:int;
			var tickMarkField:TextField;
			var step:int = int((max/5)/100)*100;
			trace("STEP:" + step);
			var milesNotDriven:int;
			for(tickMark= 1; tickMark<5; tickMark++){
				tickMarkField = new TextField();
				tickMarkField.width = 40;
				tickMarkField.x = _grid.x - tickMarkField.width;
				tickMarkField.y = _grid.height + _grid.y- (tickMark)*_grid.height/5 ;
				tickMarkField.defaultTextFormat = format;
				tickMarkField.text = String(tickMark*step);
				
				addChild(tickMarkField);
			}
		}
	}


}
