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
if(!mx.rpc.FaultEvent)
{
   mx.rpc.FaultEvent.prototype = new Object().__get__fault = function()
   {
      return this.__fault;
   };
   §§push((mx.rpc.FaultEvent.prototype = new Object()).addProperty("fault",mx.rpc.FaultEvent.prototype = new Object().__get__fault,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.rpc.FaultEvent.prototype,null,1));
}
§§pop();
