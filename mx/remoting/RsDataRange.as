if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.remoting)
{
   _global.mx.remoting = new Object();
}
§§pop();
if(!mx.remoting.RsDataRange)
{
   mx.remoting.RsDataRange.prototype = new Object().getStart = function()
   {
      return this._start;
   };
   mx.remoting.RsDataRange.prototype = new Object().getEnd = function()
   {
      return this._end;
   };
   mx.remoting.RsDataRange.prototype = new Object().setEnd = function(e)
   {
      this._end = e;
   };
   mx.remoting.RsDataRange.prototype = new Object().setStart = function(s)
   {
      this._start = s;
   };
   §§push(ASSetPropFlags(mx.remoting.RsDataRange.prototype,null,1));
}
§§pop();
