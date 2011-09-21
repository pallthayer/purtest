package{
	import flash.events.*;
	import flash.text.*;
	import flash.display.MovieClip;
	import flash.geom.Point;
	import flash.display.*;
	import flash.display.Sprite;

	public class LinePlot extends MovieClip{
		private var _numberOfDataPoints:int;
		private var _labels:Array;
		private var _gridDensity:Number;
		private var _piecewiseLinear:Shape;
		private var _maxLine, _aveLine:Shape;
		private var _dataPoints:Array;
		private var _mean, _max:Object;
		private var _summary:MovieClip;
		private var _type:String;
		private var _infoBox:InfoBox;
		private var _container:MovieClip;
		private var _months:Array =  new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		public function LinePlot(labels:Array, gridDensity:Number, container:MovieClip){
			_labels = labels;
			_container = container;
			_gridDensity = gridDensity;
		}
		
		public function loadData(value:Array, summary:MovieClip){
			_summary = summary;
			drawVerticalLines(value.length);
			_dataPoints = new Array();
			var dataPoint:DataPoint;
			for(var i=0;i<value.length;i++){
				dataPoint = new DataPoint(value[i]["savingsInGas"], value[i]["milesNotDriven"],value[i]["carsOffRoad"], value[i]["savingsInCO2"], value[i]["start"], value[i]["end"]);
				
				
				//dataPoint.x = i*_gridDensity; dataPoint.y = 200 - (value[i]["savingsInGas"]*160)/max["savingsInGas"];
				
				_dataPoints.push(dataPoint);
				dataPoint.addEventListener(MouseEvent.CLICK, clicked );
				dataPoint.visible = false;
				addChild(dataPoint);
			}			
		}
		public function plot(type:String, value:Array, startDate:String, max:Object, mean:Object, plotHeight:int, gridHeight:int):void{
			//var startMonth:Number = startDate.split("/")[0];
			//var startYear:Number = startDate.split("/")[1];
			_mean = mean;
			_max = max;
			_type = type;
			try{
				removeChild(_maxLine);
				removeChild(_aveLine);
				removeChild(_piecewiseLinear);
				removeChild(_infoBox);
			}
			catch(errObject:Error){}	

			
			
			_piecewiseLinear = new Shape();		
			_piecewiseLinear.graphics.lineStyle(4, 0x00a551, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			
			addChild(_piecewiseLinear);
			
			var yValue:Number;
			for(var i=0;i<value.length;i++){
				switch(type){
					case ("savingsInGas"): 
						yValue = _dataPoints[i].savingsInGas*plotHeight/max["savingsInGas"];
					break;
					case ("milesNotDriven"): 
						yValue = _dataPoints[i].milesNotDriven*plotHeight/max["milesNotDriven"];
					break;					
					case ("carsOffRoad"): 
						yValue = _dataPoints[i].carsOffRoad*plotHeight/max["carsOffRoad"];
					break;
					case ("savingsInCO2"): 
						yValue = _dataPoints[i].savingsInCO2*plotHeight/max["savingsInCO2"];
					break;					
				}
				_dataPoints[i].x = i*_gridDensity; _dataPoints[i].y = 200 - yValue;
				_dataPoints[i].visible = true;
				if(i==0){ 
					_piecewiseLinear.graphics.moveTo(0, gridHeight - yValue);
				}
				else{
					_piecewiseLinear.graphics.lineTo(i*_gridDensity,gridHeight - yValue);
				}
			}
			addChild(_piecewiseLinear);
			setChildIndex(_piecewiseLinear,0);
			
			_maxLine = new Shape();		
			_maxLine.graphics.lineStyle(4, 0xCCCCCC, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			_aveLine = new Shape();
			_aveLine.graphics.lineStyle(4, 0xCCCCCC, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			var maxHeight, aveHeight: Number;
			maxHeight = gridHeight - plotHeight;
			
			aveHeight = gridHeight - _mean[type]*plotHeight/_max[type];
			_maxLine.graphics.moveTo(0, maxHeight);
			_maxLine.graphics.lineTo(this.width, maxHeight);
			_aveLine.graphics.moveTo(0, aveHeight);
			_aveLine.graphics.lineTo(this.width, aveHeight);
			addChild(_maxLine);
			setChildIndex(_maxLine,0);
			//swapChildren(_maxLine, _piecewiseLinear);
			addChild(_aveLine);
			setChildIndex(_aveLine,_maxLine+1);
			_container.drawYMarkings(maxHeight,aveHeight);
			_dataPoints[_dataPoints.length-1]._nodeBtn.dispatchEvent(new MouseEvent(MouseEvent.CLICK));
			//drawLabels(startMonth, startYear);
			drawLabels();
		}
		public function clicked(event:MouseEvent){
			try{
				removeChild(_infoBox);
			}
			catch(errObject:Error){}				
			_infoBox = new InfoBox();
			if(event.target.parent.x < this.width - _infoBox.width){
				_infoBox.x = event.target.parent.x;
			}
			else{
				_infoBox.x = event.target.parent.x - _infoBox.width+10;
			}
			_infoBox.y = event.target.parent.y;
			switch(_type){
				case ("savingsInGas"): 
					_infoBox._infoText.text = "$" +event.target.parent.savingsInGas;
				break;
				case ("milesNotDriven"): 
					_infoBox._infoText.text =  event.target.parent.milesNotDriven + "mi";
				break;					
				case ("carsOffRoad"): 
					_infoBox._infoText.text =  event.target.parent.carsOffRoad;
				break;
				case ("savingsInCO2"): 
					_infoBox._infoText.text = event.target.parent.savingsInCO2+ " lbs";
				break;		
			}
			
			addChild(_infoBox);
			_summary._summaryTitle.text = "Week of " + event.target.parent.start;
			_summary._gasField.text = "$" + event.target.parent.savingsInGas;
			_summary._mindField.text =  event.target.parent.milesNotDriven + "mi";
			_summary._corsField.text = event.target.parent.carsOffRoad;
			_summary._ghField.text = event.target.parent.savingsInCO2 + " lbs";
		}
		public function get timeRangeInPixels():Number{
			return _numberOfDataPoints;
		}
		public function drawVerticalLines(len:Number):void{
			var i:int;
			var line:Shape = new Shape();	
			line.graphics.lineStyle(1, 0x999999, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			line.graphics.lineStyle(1, 0x999999, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			for(i=1; i<len-1; i++){
				line.graphics.moveTo(i*_gridDensity,0);
				line.graphics.lineTo(i*_gridDensity,200);
				addChild(line);
			}
		}

		public function drawLabels():void{
			var i:int;
			
			var format:TextFormat = new TextFormat();
            format.font = "Verdana";
            format.color = 0x999999;
            format.size = 10;
			var dataLabel:TextField;
			
			var day, month, year:Number;
			
			for(i=0; i < _dataPoints.length-1; i+=3){
				dataLabel = new TextField();
				dataLabel.multiline = true;
				dataLabel.x = i*_gridDensity; //+ _gridDensity/2;
				dataLabel.y = 0;
				dataLabel.width=70;
				dataLabel.defaultTextFormat = format;
				
				day = _dataPoints[i].start.split("/")[1];
				month = _dataPoints[i].start.split("/")[0];
				year = _dataPoints[i].start.split("/")[2];
				//trace( String(year).substring(2));
				//dataLabel.text = _months[(month-1)%_months.length] + " " +day +"\n" + year;
				dataLabel.text = month + "-" +day +"-" + String(year).substring(2);
				addChild(dataLabel);
			}
		}
	}
}
