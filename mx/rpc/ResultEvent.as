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
if(!mx.rpc.ResultEvent)
{
   mx.rpc.ResultEvent.prototype = new Object().__get__result = function()
   {
      return this.__result;
   };
   §§push((mx.rpc.ResultEvent.prototype = new Object()).addProperty("result",mx.rpc.ResultEvent.prototype = new Object().__get__result,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.rpc.ResultEvent.prototype,null,1));
}
§§pop();
