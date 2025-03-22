if(!_global.mx)
{
   _global.mx = new Object();
}
§§pop();
if(!_global.mx.core)
{
   _global.mx.core = new Object();
}
§§pop();
if(!mx.core.View)
{
   mx.core.View.prototype = new mx.core.UIComponent().init = function()
   {
      super.init();
      this.tabChildren = true;
      this.tabEnabled = false;
      this.boundingBox_mc._visible = false;
      this.boundingBox_mc._width = this.boundingBox_mc._height = 0;
   };
   mx.core.View.prototype = new mx.core.UIComponent().size = function()
   {
      this.border_mc.move(0,0);
      this.border_mc.setSize(this.__get__width(),this.__get__height());
      this.doLayout();
   };
   mx.core.View.prototype = new mx.core.UIComponent().draw = function()
   {
      this.size();
   };
   mx.core.View.prototype = new mx.core.UIComponent().__get__numChildren = function()
   {
      var _loc3_ = mx.core.View.childNameBase;
      var _loc2_ = 0;
      while(true)
      {
         if(this[_loc3_ + _loc2_] == undefined)
         {
            return _loc2_;
         }
         _loc2_ = _loc2_ + 1;
      }
      return -1;
   };
   mx.core.View.prototype = new mx.core.UIComponent().__get__tabIndex = function()
   {
      return !this.tabEnabled?undefined:this.__tabIndex;
   };
   mx.core.View.prototype = new mx.core.UIComponent().addLayoutObject = function(object)
   {
   };
   mx.core.View.prototype = new mx.core.UIComponent().createChild = function(className, instanceName, initProps)
   {
      if(this.depth == undefined)
      {
         this.depth = 1;
      }
      var _loc2_ = undefined;
      if(typeof className == "string")
      {
         this.depth = this.depth + 1;
         _loc2_ = this.createObject(className,instanceName,this.depth,initProps);
      }
      else
      {
         this.depth = this.depth + 1;
         _loc2_ = this.createClassObject(className,instanceName,this.depth,initProps);
      }
      if(_loc2_ == undefined)
      {
         this.depth = this.depth + 1;
         _loc2_ = this.loadExternal(className,this._loadExternalClass,instanceName,this.depth,initProps);
      }
      else
      {
         this[mx.core.View.childNameBase + this.__get__numChildren()] = _loc2_;
         _loc2_._complete = true;
         this.childLoaded(_loc2_);
      }
      this.addLayoutObject(_loc2_);
      return _loc2_;
   };
   mx.core.View.prototype = new mx.core.UIComponent().getChildAt = function(childIndex)
   {
      return this[mx.core.View.childNameBase + childIndex];
   };
   mx.core.View.prototype = new mx.core.UIComponent().destroyChildAt = function(childIndex)
   {
      if(!(childIndex >= 0 && childIndex < this.__get__numChildren()))
      {
         return undefined;
      }
      var _loc4_ = mx.core.View.childNameBase + childIndex;
      var _loc6_ = this.__get__numChildren();
      var _loc3_ = undefined;
      §§enumerate(this);
      while(true)
      {
         if((var _loc0_ = §§pop()) != null)
         {
            _loc3_ = _loc0_;
            if(_loc3_ == _loc4_)
            {
               _loc4_ = "";
               this.destroyObject(_loc3_);
               var _loc2_ = Number(childIndex);
               break;
            }
            continue;
         }
         _loc2_ = Number(childIndex);
         break;
      }
      while(_loc2_ < _loc6_ - 1)
      {
         this[mx.core.View.childNameBase + _loc2_] = this[mx.core.View.childNameBase + (_loc2_ + 1)];
         _loc2_ = _loc2_ + 1;
      }
      delete this.mx.core.View.childNameBase + (_loc6_ - 1);
      this.depth = this.depth - 1;
   };
   mx.core.View.prototype = new mx.core.UIComponent().initLayout = function()
   {
      if(!this.hasBeenLayedOut)
      {
         this.doLayout();
      }
   };
   mx.core.View.prototype = new mx.core.UIComponent().doLayout = function()
   {
      this.hasBeenLayedOut = true;
   };
   mx.core.View.prototype = new mx.core.UIComponent().createChildren = function()
   {
      if(this.border_mc == undefined)
      {
         this.border_mc = this.createClassChildAtDepth(_global.styles.rectBorderClass,mx.managers.DepthManager.kBottom,{styleName:this});
      }
      this.doLater(this,"initLayout");
   };
   mx.core.View.prototype = new mx.core.UIComponent().convertToUIObject = function(obj)
   {
   };
   mx.core.View.prototype = new mx.core.UIComponent().childLoaded = function(obj)
   {
      this.convertToUIObject(obj);
   };
   mx.core.View = function()
   {
      super();
   }.extension = function()
   {
      mx.core.ExternalContent.enableExternalContent();
   };
   mx.core.View = function()
   {
      super();
   }.symbolName = "View";
   mx.core.View = function()
   {
      super();
   }.symbolOwner = mx.core.View;
   mx.core.View = function()
   {
      super();
   }.version = "2.0.2.123";
   mx.core.View.prototype = new mx.core.UIComponent().className = "View";
   mx.core.View = function()
   {
      super();
   }.childNameBase = "_child";
   mx.core.View.prototype = new mx.core.UIComponent().hasBeenLayedOut = false;
   mx.core.View.prototype = new mx.core.UIComponent()._loadExternalClass = "UIComponent";
   §§push((mx.core.View.prototype = new mx.core.UIComponent()).addProperty("numChildren",mx.core.View.prototype = new mx.core.UIComponent().__get__numChildren,function()
   {
   }
   ));
   §§push((mx.core.View.prototype = new mx.core.UIComponent()).addProperty("tabIndex",mx.core.View.prototype = new mx.core.UIComponent().__get__tabIndex,function()
   {
   }
   ));
   §§push(ASSetPropFlags(mx.core.View.prototype,null,1));
}
§§pop();
