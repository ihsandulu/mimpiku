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
if(!mx.rpc.Fault)
{
   mx.rpc.Fault.prototype = new Object().__get__faultcode = function()
   {
      return this.__faultcode;
   };
   mx.rpc.Fault.prototype = new Object().__get__faultstring = function()
   {
      return this.__faultstring;
   };
   mx.rpc.Fault.prototype = new Object().__get__detail = function()
   {
      return this.__detail;
   };
   mx.rpc.Fault.prototype = new Object().__get__description = function()
   {
      var _loc2_ = this;
      §§push(_loc1_);
      §§push(_loc2_);
      if(_loc2_.__description == null)
      {
         if(_loc2_.__faultstring.indexOf(":") > -1)
         {
            _loc2_.__description = _loc2_.__faultstring.substring(_loc2_.__faultstring.indexOf(":") + 1);
            var _loc1_ = 0;
            while(_loc2_.__description.indexOf(" ",_loc1_) == _loc1_)
            {
               _loc1_ = _loc1_ + 1;
            }
            if(_loc1_ > 0)
            {
               _loc2_.__description = _loc2_.__description.substring(_loc1_);
            }
         }
         else
         {
            _loc2_.__description = _loc2_.__faultstring;
         }
      }
      var _loc0_ = _loc2_.__description;
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   };
   mx.rpc.Fault.prototype = new Object().__get__type = function()
   {
      return this.__type;
   };
   §§push((mx.rpc.Fault.prototype = new Object()).addProperty("description",mx.rpc.Fault.prototype = new Object().__get__description,function()
   {
   }
   ));
   §§push((mx.rpc.Fault.prototype = new Object()).addProperty("detail",mx.rpc.Fault.prototype = new Object().__get__detail,function()
   {
   }
   ));
   §§push((mx.rpc.Fault.prototype = new Object()).addProperty("faultcode",mx.rpc.Fault.prototype = new Object().__get__faultcode,function()
   {
   }
   ));
   §§push((mx.rpc.Fault.prototype = new Object()).addProperty("faultstring",mx.rpc.Fault.prototype = new Object().__get__faultstring,function()
   {
   }
   ));
   §§push((mx.rpc.Fault.prototype = new Object()).addProperty("type",mx.rpc.Fault.prototype = new Object().__get__type,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.rpc.Fault.prototype,null,1));
}
§§pop();
