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
if(!mx.remoting.DataGlue)
{
   mx.remoting.DataGlue.prototype = new Object().__get__dataProvider = function()
   {
      return this.__dataProv;
   };
   mx.remoting.DataGlue.prototype = new Object().__get__labelString = function()
   {
      return this.__labelStr;
   };
   mx.remoting.DataGlue.prototype = new Object().__set__labelString = function(val)
   {
      this.__labelStr = val;
      return this.__get__labelString();
   };
   mx.remoting.DataGlue.prototype = new Object().__get__dataString = function()
   {
      return this.__dataStr;
   };
   mx.remoting.DataGlue.prototype = new Object().__set__dataString = function(val)
   {
      this.__dataStr = val;
      return this.__get__dataString();
   };
   mx.remoting.DataGlue = function(dp)
   {
      super();
      this.__dataProv = dp;
   }.bindFormatStrings = function(dataConsumer, dp, labelStr, dataStr)
   {
      var _loc1_ = new mx.remoting.DataGlue(dp);
      _loc1_.__set__labelString(labelStr);
      _loc1_.__set__dataString(dataStr);
      _loc1_.getItemAt = mx.remoting.DataGlue.prototype.getItemAt_FormatString;
      dataConsumer.dataProvider = _loc1_;
      _loc1_;
   };
   mx.remoting.DataGlue = function(dp)
   {
      super();
      this.__dataProv = dp;
   }.bindFormatFunction = function(dataConsumer, dp, formatFunc)
   {
      var _loc1_ = new mx.remoting.DataGlue(dp);
      _loc1_.formatFunction = formatFunc;
      _loc1_.getItemAt = mx.remoting.DataGlue.prototype.getItemAt_FormatFunction;
      dataConsumer.setDataProvider(_loc1_);
      _loc1_;
   };
   mx.remoting.DataGlue.prototype = new Object().addEventListener = function(eventName, listener)
   {
      this.dataProvider.addEventListener(eventName,listener);
   };
   mx.remoting.DataGlue.prototype = new Object().__get__length = function()
   {
      return this.getLength();
   };
   mx.remoting.DataGlue.prototype = new Object().getLength = function()
   {
      return this.dataProvider.length;
   };
   mx.remoting.DataGlue.prototype = new Object().format = function(formatString, item)
   {
      var _loc3_ = formatString.split("#");
      var result = "";
      var tlen = _loc3_.length;
      var _loc2_ = undefined;
      var _loc1_ = 0;
      while(_loc1_ < tlen)
      {
         result = result + _loc3_[_loc1_];
         _loc2_ = _loc3_[_loc1_ + 1];
         if(_loc2_ != undefined)
         {
            result = result + item[_loc2_];
         }
         _loc1_ = _loc1_ + 2;
      }
      var _loc0_ = result;
      _loc3_;
      _loc2_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.DataGlue.prototype = new Object().getItemAt_FormatString = function(index)
   {
      var _loc2_ = this;
      var _loc1_ = _loc2_.dataProvider.getItemAt(index);
      var _loc0_ = _loc1_ == "in progress" || _loc1_ == undefined?_loc1_:{label:_loc2_.format(_loc2_.__get__labelString(),_loc1_),data:(_loc2_.__get__dataString() != null?_loc2_.format(_loc2_.__get__dataString(),_loc1_):_loc1_)};
      _loc2_;
      _loc1_;
      return _loc0_;
   };
   mx.remoting.DataGlue.prototype = new Object().getItemAt_FormatFunction = function(index)
   {
      var _loc1_ = this.dataProvider.getItemAt(index);
      var _loc0_ = _loc1_ == "in progress" || _loc1_ == undefined?_loc1_:this.formatFunction(_loc1_);
      _loc1_;
      return _loc0_;
   };
   mx.remoting.DataGlue.prototype = new Object().getItemID = function(index)
   {
      return this.dataProvider.getItemID(index);
   };
   mx.remoting.DataGlue.prototype = new Object().addItemAt = function(index, value)
   {
      this.dataProvider.addItemAt(index,value);
   };
   mx.remoting.DataGlue.prototype = new Object().addItem = function(value)
   {
      this.dataProvider.addItem(value);
   };
   mx.remoting.DataGlue.prototype = new Object().removeItemAt = function(index)
   {
      this.dataProvider.removeItemAt(index);
   };
   mx.remoting.DataGlue.prototype = new Object().removeAll = function()
   {
      this.dataProvider.removeAll();
   };
   mx.remoting.DataGlue.prototype = new Object().replaceItemAt = function(index, itemObj)
   {
      this.dataProvider.replaceItemAt(index,itemObj);
   };
   mx.remoting.DataGlue.prototype = new Object().sortItemsBy = function(fieldNames, optionFlags)
   {
      this.dataProvider.sortItemsBy(fieldNames,optionFlags);
   };
   mx.remoting.DataGlue.prototype = new Object().sortItems = function(compareFunc, optionFlags)
   {
      this.dataProvider.sortItems(compareFunc,optionFlags);
   };
   mx.remoting.DataGlue = function(dp)
   {
      super();
      this.__dataProv = dp;
   }.version = "1.2.0.124";
   §§push((mx.remoting.DataGlue.prototype = new Object()).addProperty("dataProvider",mx.remoting.DataGlue.prototype = new Object().__get__dataProvider,function()
   {
   }
   ));
   §§push((mx.remoting.DataGlue.prototype = new Object()).addProperty("dataString",mx.remoting.DataGlue.prototype = new Object().__get__dataString,mx.remoting.DataGlue.prototype = new Object().__set__dataString));
   §§push((mx.remoting.DataGlue.prototype = new Object()).addProperty("labelString",mx.remoting.DataGlue.prototype = new Object().__get__labelString,mx.remoting.DataGlue.prototype = new Object().__set__labelString));
   §§push((mx.remoting.DataGlue.prototype = new Object()).addProperty("length",mx.remoting.DataGlue.prototype = new Object().__get__length,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.remoting.DataGlue.prototype,null,1));
}
§§pop();
