class mx.rpc.DefaultResponder
{
   function DefaultResponder(t)
   {
      this.__set__target(t);
   }
   function __get__target()
   {
      return this.__target;
   }
   function __set__target(t)
   {
      this.__target = t;
      return this.__get__target();
   }
   function onResult(event)
   {
      trace("RPC Result: " + event.__get__result());
   }
   function onFault(event)
   {
      trace("RPC Fault: " + event.fault.faultstring);
   }
}
