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
	import fl.motion.Color;

	//import Photo;
	
	public class Polygon extends MovieClip{
			private var _fill:MovieClip //A Movie Clip for the fill
			private var _stroke:Shape;
			private var _infoWindow:InfoWindow;
			private var _previousX, _previousY:int;
			private var _poolAttribute:Object;
			
			private var _colorObj:ColorTransform;
			
		public function Polygon(vertex:Array, poolAttribute:Object, minIndex:Number, maxIndex:Number){
			_poolAttribute = poolAttribute;
			var lowerBound = 0.5; 
			var upperBound = 1;
			var multiplier:Number;
			if(maxIndex == minIndex){
				multiplier = 1;
			}
			else{
				var slope = (upperBound - lowerBound)/(maxIndex - minIndex);
				multiplier = slope * (poolAttribute["index"] - minIndex)  + lowerBound;
			}
			
			_infoWindow = new InfoWindow();
			var line:Shape = new Shape();		
			line.graphics.lineStyle(1, 0xffffff, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
			line.graphics.beginFill(0xa400ff);
			line.graphics.beginFill( 0xff00ff);
          	line.graphics.moveTo(vertex[0][0], vertex[0][1]);
			//trace(vertex.length+ " "+ vertex[0][0]);
			for(var i=1;i<vertex.length;i++){
				line.graphics.lineTo(vertex[i][0],vertex[i][1]);
			}
			line.graphics.lineTo(vertex[0][0],vertex[0][1]);
			line.graphics.endFill();
			_fill = new MovieClip();
			_fill.addChild(line);
			
			_colorObj = new ColorTransform( multiplier, 0,  multiplier);
			_fill.transform.colorTransform=_colorObj;

			_stroke = new Shape();
			_stroke.graphics.lineStyle(1, 0xffffff, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
           	
			_stroke.graphics.moveTo(vertex[0][0], vertex[0][1]);
			for(i=1;i<vertex.length;i++){
				_stroke.graphics.lineTo(vertex[i][0],vertex[i][1]);
			}
			_stroke.graphics.lineTo(vertex[0][0],vertex[0][1]);
			
			_fill.addEventListener(MouseEvent.MOUSE_OVER,mouseOverHandler );
			_fill.addEventListener(MouseEvent.MOUSE_OUT, mouseOutHandler);
			this.addChild(_fill);
			this.addChild(_stroke);
			
		}
		public function mouseOverHandler(event:MouseEvent){
			var colorObj:ColorTransform = new ColorTransform();
			colorObj.color = 0xffe383;
			_fill.transform.colorTransform=colorObj;
			_infoWindow.x = event.stageX;
			_infoWindow.y = event.stageY;
			_infoWindow._info.text = _poolAttribute["name"] + "\nMembers: " + _poolAttribute["members"] + "\nPurpool Index: " + _poolAttribute["index"];
			parent.parent.addChild(_infoWindow);
			_previousX = event.stageX;
			_previousY = event.stageY;
			addEventListener(MouseEvent.MOUSE_MOVE, mouseMoved);
		}
		public function mouseOutHandler(event:MouseEvent){
			//var colorObj:ColorTransform = new ColorTransform();
			//colorObj.color = 0xff00ff;
			_fill.transform.colorTransform= _colorObj;
			parent.parent.removeChild(_infoWindow);	
			removeEventListener(MouseEvent.MOUSE_MOVE, mouseMoved);
		}
		public function mouseMoved(event:MouseEvent){
			_infoWindow.x += event.stageX - _previousX; _infoWindow.y += event.stageY - _previousY;
			_previousX = event.stageX; _previousY = event.stageY; 
		}			
	}
}
