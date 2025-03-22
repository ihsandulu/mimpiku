class mx.data.binding.ObjectDumper
{
   function ObjectDumper()
   {
      this.inProgress = new Array();
   }
   function realToString(obj, showFunctions, showUndefined, showXMLstructures, maxLineLength, indent)
   {
      var _loc1_ = obj;
      var x = 0;
      while(true)
      {
         if(x < this.inProgress.length)
         {
            if(this.inProgress[x] == _loc1_)
            {
               §§push("***");
               break;
            }
            x++;
            continue;
         }
         this.inProgress.push(_loc1_);
         indent++;
         var t = typeof _loc1_;
         var result;
         if(_loc1_ instanceof XMLNode && showXMLstructures != true)
         {
            result = _loc1_.toString();
         }
         else if(_loc1_ instanceof Date)
         {
            result = _loc1_.toString();
         }
         else if(t == "object")
         {
            var _loc3_ = new Array();
            if(_loc1_ instanceof Array)
            {
               result = "[";
               var i = 0;
               while(i < _loc1_.length)
               {
                  _loc3_.push(i);
                  i++;
               }
            }
            else
            {
               result = "{";
               for(var i in _loc1_)
               {
                  _loc3_.push(i);
               }
               _loc3_.sort();
            }
            var sep = "";
            var _loc2_ = 0;
            while(_loc2_ < _loc3_.length)
            {
               var val = _loc1_[_loc3_[_loc2_]];
               var show = true;
               if(typeof val == "function")
               {
                  show = showFunctions == true;
               }
               if(typeof val == "undefined")
               {
                  show = showUndefined == true;
               }
               if(show)
               {
                  result = result + sep;
                  if(!(_loc1_ instanceof Array))
                  {
                     result = result + (_loc3_[_loc2_] + ": ");
                  }
                  result = result + this.realToString(val,showFunctions,showUndefined,showXMLstructures,maxLineLength,indent);
                  sep = ", `";
               }
               _loc2_ = _loc2_ + 1;
            }
            if(_loc1_ instanceof Array)
            {
               result = result + "]";
            }
            else
            {
               result = result + "}";
            }
         }
         else if(t == "function")
         {
            result = "function";
         }
         else if(t == "string")
         {
            result = "\"" + _loc1_ + "\"";
         }
         else
         {
            result = String(_loc1_);
         }
         if(result == "undefined")
         {
            result = "-";
         }
         this.inProgress.pop();
         §§push(mx.data.binding.ObjectDumper.replaceAll(result,"`",result.length >= maxLineLength?"\n" + this.doIndent(indent):""));
         break;
      }
      _loc0_ = _loc3_;
      _loc3_ = _loc2_;
      _loc2_ = _loc1_;
      _loc1_ = §§pop();
      return _loc0_;
   }
   function doIndent(indent)
   {
      var _loc3_ = indent;
      var _loc2_ = "";
      var _loc1_ = 0;
      while(_loc1_ < _loc3_)
      {
         _loc2_ = _loc2_ + "     ";
         _loc1_ = _loc1_ + 1;
      }
      var _loc0_ = _loc2_;
      _loc3_;
      _loc2_;
      _loc1_;
      return _loc0_;
   }
   static function toString(obj, showFunctions, showUndefined, showXMLstructures, maxLineLength, indent)
   {
      var _loc1_ = indent;
      var _loc2_ = maxLineLength;
      var _loc3_ = new mx.data.binding.ObjectDumper();
      §§push(_loc1_);
      §§push(_loc2_);
      §§push(_loc3_);
      if(_loc2_ == undefined)
      {
         _loc2_ = 100;
      }
      if(_loc1_ == undefined)
      {
         _loc1_ = 0;
      }
      var _loc0_ = _loc3_.realToString(obj,showFunctions,showUndefined,showXMLstructures,_loc2_,_loc1_);
      _loc3_ = §§pop();
      _loc2_ = §§pop();
      _loc1_ = §§pop();
      return _loc0_;
   }
   static function replaceAll(str, from, to)
   {
      var _loc3_ = str.split(from);
      var result = "";
      var _loc2_ = "";
      var _loc1_ = 0;
      while(_loc1_ < _loc3_.length)
      {
         result = result + (_loc2_ + _loc3_[_loc1_]);
         _loc2_ = to;
         _loc1_ = _loc1_ + 1;
      }
      var _loc0_ = result;
      _loc3_;
      _loc2_;
      _loc1_;
      return _loc0_;
   }
}
