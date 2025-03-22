class mx.remoting.Operation
{
   function Operation(methodName, parent)
   {
      var _loc1_ = this;
      _loc1_.__service = parent;
      _loc1_.__responder = parent.responder;
      _loc1_.__methodName = methodName;
      _loc1_.__invokationName = _loc1_.__service.__get__name() + "." + methodName;
      _loc1_.__request = new Object();
      _loc1_.__arguments = new Array();
      _loc1_;
   }
   function createThenSend(Void)
   {
      this.createArguments();
      return this.send();
   }
   function send(Void)
   {
      var _loc1_ = this;
      _loc1_.__service.log.logInfo("Invoking " + _loc1_.__methodName + " on " + _loc1_.__service.__get__name());
      var _loc3_ = new mx.remoting.PendingCall(_loc1_.__service,_loc1_.__methodName);
      _loc3_.__set__responder(_loc1_.__responder);
      var _loc2_ = null;
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc1_.__arguments == null)
      {
         _loc2_ = new Array();
      }
      else
      {
         _loc2_ = _loc1_.__arguments.concat();
      }
      _loc1_.__invokationName = _loc1_.__service.__get__name() + "." + _loc1_.__methodName;
      _loc2_.unshift(_loc1_.__invokationName,_loc3_);
      _loc1_.__service.connection.call.apply(_loc1_.__service.__get__connection(),_loc2_);
      var _loc0_ = _loc3_;
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   }
   function invoke(a)
   {
      this.__arguments = a;
   }
   function __get__responder()
   {
      return this.__responder;
   }
   function __set__responder(r)
   {
      this.__responder = r;
      return this.__get__responder();
   }
   function __get__request()
   {
      return this.__request;
   }
   function __set__request(r)
   {
      this.__request = r;
      return this.__get__request();
   }
   function __get__name()
   {
      return this.__methodName;
   }
   function createArguments()
   {
      var _loc1_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc1_.__request != null)
      {
         _loc1_.__arguments = new Array();
         for(var _loc2_ in _loc1_.__request)
         {
            if(_loc2_ != "arguments")
            {
               _loc1_.__arguments.unshift(_loc1_.__request[_loc2_]);
            }
         }
      }
      _loc2_ = §§pop();
      _loc1_ = §§pop();
   }
}
