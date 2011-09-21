package {
  import flash.display.MovieClip;
  public class DataPoint extends MovieClip {
    private var _savingsInGas:Number;
	private var _milesNotDriven:Number;
	private var _carsOffRoad:Number;
	private var _savingsInCO2:Number;
	private var _start, _end:String;
    public function DataPoint(savingsInGas:Number, milesNotDriven:Number, carsOffRoad:Number,savingsInCO2:Number ,start:String, end:String) {
 		_savingsInGas = savingsInGas;
		trace("DATA POINT: " + _savingsInGas);
		_milesNotDriven = milesNotDriven;
		_carsOffRoad =  carsOffRoad;
		_savingsInCO2 = savingsInCO2;
		_start = start; _end = end;
    }
	public function get savingsInGas():Number{
		return _savingsInGas;
	}
	public function get milesNotDriven():Number{
		return _milesNotDriven;
	}
	public function get carsOffRoad():Number{
		return _carsOffRoad;
	}
	public function get savingsInCO2():Number{
		return _savingsInCO2;
	}
	public function get start():String{
		return _start;
	}
	public function get end():String{
		return _end;
	}
  }
}
