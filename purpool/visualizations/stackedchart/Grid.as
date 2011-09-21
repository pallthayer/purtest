package{
	import flash.events.*;
	import flash.text.*;
	import flash.display.MovieClip;
	import flash.geom.Point;
	import flash.display.*;
	import flash.geom.ColorTransform;

	//import Photo;
	
	public class Grid extends MovieClip{
		private var _w, _h:int;
		
		public function Grid(w:int, h:int){
			_w = w; _h = h;
			drawBorder();
		}
		public function drawBorder():void{
			var border:Shape = new Shape();		
			border.graphics.lineStyle(1, 0x999999, 1, false, LineScaleMode.VERTICAL, CapsStyle.NONE, JointStyle.MITER, 2);
          	border.graphics.moveTo(0, 0);
			border.graphics.lineTo(_w,0);
			border.graphics.lineTo(_w,_h);
			border.graphics.lineTo(0,_h);
			border.graphics.lineTo(0,0);
			addChild(border);
		}
	}
}
