package{
	import flash.net.*;
	import flash.events.*;
	import flash.text.*;
	import flash.display.MovieClip;
	import flash.geom.Point;
	import flash.display.*;
	import flash.external.ExternalInterface;
	import flash.display.Sprite;
	import flash.geom.ColorTransform;
	import flash.utils.ByteArray;
	
	import Polygon;
	
	public class StackPlot extends MovieClip{
		private var _numberOfDataPoints:int;
		private var _gridDensity:Number;
		private var _months:Array =  new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		public function StackPlot(gridDensity:Number){
			_gridDensity = gridDensity;
		}
		public function plot(poolAttributes:Array, values:Array, weeks:Array):void{
			//var startMonth:Number = startDate.split("/")[0];
			//var startYear:Number = startDate.split("/")[1];
			
			var vertexList:Array = new Array();
			var polygon:Array = new Array();
			var i, pool:int;
			_numberOfDataPoints = values[0].length;
			drawVerticalLines(_numberOfDataPoints);
			
			var maxIndex:Number = poolAttributes[0].index;
			var minIndex:Number = poolAttributes[0].index;
			for(pool=1; pool<poolAttributes.length; pool++){
				
				if(poolAttributes[pool].index > maxIndex){ 
					maxIndex = poolAttributes[pool].index;
				}
				else if(poolAttributes[pool].index < minIndex) {
					minIndex = poolAttributes[pool].index;
				}
			}
			var baseline:Array = new Array();
			for(i=0;i<_numberOfDataPoints;i++){
				baseline[i] = new Array(_gridDensity*i, 400);
			}
			vertexList[0] = baseline;
			
			var topPoly:Array = new Array();

			var yTotal:Array = new Array(); //cumulative y coords
			for(i=0;i<_numberOfDataPoints;i++) yTotal[i]=400;
		
			for(pool=0; pool<values.length; pool++){
				vertexList[pool+1] = new Array();
				for(i=0;i<_numberOfDataPoints;i++){
					yTotal[i] = yTotal[i] - values[pool][i];
					vertexList[pool+1][i] = [_gridDensity*i , yTotal[i] ];
				}
				topPoly = vertexList[pool+1].concat(vertexList[pool].reverse());
				polygon[pool] = new Polygon(topPoly, poolAttributes[pool], minIndex, maxIndex);
				
				addChild(polygon[pool]);
				
			}
			drawLabels(weeks);

		}
		public function get timeRangeInPixels():Number{
			return _numberOfDataPoints;
		}
		
		public function drawVerticalLines(len:Number):void{
			var i:int;
			var line:Shape = new Shape();	
			line.graphics.lineStyle(1, 0x7E7872, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			line.graphics.lineStyle(1, 0x7E7872, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			for(i=1; i<len-1; i++){
				line.graphics.moveTo(i*_gridDensity,0);
				line.graphics.lineTo(i*_gridDensity,400);
				addChild(line);
			}
		}

		public function drawLabels(weeks:Array):void{
			var i:int;
			
			var format:TextFormat = new TextFormat();
            format.font = "Arial";
            format.color = 0xFFFFFF;
            format.size = 10;
			var dataLabel:TextField;
			
			var day, month, year:Number;
			
			for(i=0; i < weeks.length-1; i++){
				dataLabel = new TextField();
				dataLabel.multiline = true;
				dataLabel.selectable = false;
				dataLabel.x = i*_gridDensity; //+ _gridDensity/2;
				dataLabel.y = 0;
				dataLabel.width=_gridDensity;
				dataLabel.defaultTextFormat = format;
				
				day = weeks[i].split("/")[1];
				month = weeks[i].split("/")[0];
				year = weeks[i].split("/")[2];
				//dataLabel.text = "Week of \n" + _months[(month-1)%_months.length] + " " +day +"\n" + year;
				dataLabel.text = month + "-" +day +"-" + year;
				trace(dataLabel.text);
				//dataLabel.text = _months[month%_months.length] +"\n" + year;
				//month+=3;
				//year = startYear + int(month/12);
				addChild(dataLabel);
			}
		}
	}
}
