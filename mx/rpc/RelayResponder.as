if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.rpc)
{
   _global.mx.rpc = new Object();
}
§§pop();
if(!mx.rpc.RelayResponder)
{
   mx.rpc.RelayResponder.prototype = new Object().onFault = function(fault)
   {
      this[this.__onFault].call(this,fault);
   };
   mx.rpc.RelayResponder.prototype = new Object().onResult = function(result)
   {
      this[this.__onResult].call(this,result);
   };
   §§push(ASSetPropFlags(mx.rpc.RelayResponder.prototype,null,1));
}
§§pop();
