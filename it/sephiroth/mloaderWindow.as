class it.sephiroth.mloaderWindow extends mx.core.UIComponent
{
   var className = "it.sephiroth.mloaderWindow";
   var max_w = 128;
   var min_w = 1;
   static var symbolName = "mloaderWindow";
   static var symbolOwner = it.sephiroth.mloaderWindow;
   function mloaderWindow()
   {
      super();
      this.progressBar = true;
      this.ls_stage = new Object();
      this.ls_stage.target = this;
      this.ls_stage.onResize = function()
      {
         if(this.target.centered)
         {
            this.target.setPosition(Stage.width / 2 - this.target.getSize()[0] / 2,Stage.height / 2 - this.target.getSize()[1] / 2);
         }
         else
         {
            this.target.updateModalWindow();
         }
      };
      Stage.addListener(this.ls_stage);
   }
   function init(Void)
   {
      super.init();
      mx.events.EventDispatcher.initialize(this);
      this._x = Math.floor(this._x);
      this._y = Math.floor(this._y);
      this.label_txt.autoSize = "left";
      this.bar_fg = this.progress.bar_fg;
      this.bar_fg._width = this.min_w;
      this.modalWindow._visible = false;
      this.modalWindow.onPress = function()
      {
      };
      this.modalWindow.useHandCursor = false;
      this.modalWindow._width = 0;
      this.modalWindow._height = 0;
   }
   function draw()
   {
      super.draw();
   }
   function createChildren(Void)
   {
      super.createChildren();
   }
   function __set__value(obj)
   {
      obj = Math.ceil(obj);
      if(obj < 0)
      {
         obj = 1;
      }
      if(obj > 100)
      {
         obj = 100;
      }
      this.progress.bar_fg._width = this.max_w / 100 * obj;
      return this.__get__value();
   }
   function __get__value()
   {
      return this.bar_fg._width / this.max_w * 100;
   }
   function __set__label(str)
   {
      this.label_txt.text = str;
      this.invalidate();
      return this.__get__label();
   }
   function __get__label()
   {
      return this.label_txt.text;
   }
   function __set__borderColor(str)
   {
      var _loc5_ = new Color(this.border_mc.border_up.line);
      var _loc3_ = new Color(this.border_mc.border_down.line);
      var _loc2_ = new Color(this.border_mc.border_middle.line);
      _loc5_.setRGB(str);
      _loc3_.setRGB(str);
      _loc2_.setRGB(str);
      return this.__get__borderColor();
   }
   function open(modal, animate, center)
   {
      if(modal == true)
      {
         this.isModal = true;
      }
      else
      {
         this.isModal = false;
      }
      this.centered = center;
      this.invalidate();
      if(this.centered)
      {
         this.setPosition(Stage.width / 2 - this.getSize()[0] / 2,Stage.height / 2 - this.getSize()[1] / 2);
      }
      var target_h = this.border_mc._height;
      if(animate == true || animate == undefined)
      {
         this.progress._visible = false;
         this.label_txt._visible = false;
         this.title_mc._visible = false;
         this.shadow_mc._visible = false;
         this.accSize(0);
         this.border_mc.dy = 0;
         this.border_mc.onEnterFrame = function()
         {
            this.dy = (this.dy + (target_h - this._height) / 1.6) / 2.3;
            this._parent.accSize(this._parent.height + this.dy);
            if(Math.abs(this.dy) < 0.2)
            {
               delete this.onEnterFrame;
               this._parent.adjustContents();
               this._parent.progress._visible = this._parent.progressBar;
               this._parent.label_txt._visible = true;
               this._parent.title_mc._visible = true;
               this._parent.shadow_mc._visible = true;
               this._parent.adjustShadow();
               this._parent.dispatchEvent({type:"draw",target:this._parent});
            }
         };
      }
      else
      {
         this.invalidate();
         this.dispatchEvent({type:"draw",target:this});
      }
   }
   function close(delay)
   {
      if(delay == undefined)
      {
         delay = 0;
      }
      var t1 = getTimer();
      this.border_mc.onEnterFrame = function()
      {
         if(getTimer() - t1 > delay * 1000)
         {
            this._parent.progress._visible = false;
            this._parent.label_txt._visible = false;
            this._parent.title_mc._visible = false;
            this._parent.shadow_mc._visible = false;
            delete this.onEnterFrame;
            this.onEnterFrame = function()
            {
               if(this._alpha < 0)
               {
                  delete this.onEnterFrame;
                  this._visible = false;
                  this._alpha = 100;
                  this._parent.dispatchEvent({type:"close",target:this._parent});
               }
               this._alpha = this._alpha - 10;
            };
         }
      };
   }
   function invalidate()
   {
      var _loc2_ = new Object();
      this.adjustContents();
      _loc2_ = this.progress.getBounds(this.border_mc);
      if(this.progressBar == false)
      {
         this.progress._visible = false;
         _loc2_.yMax = _loc2_.yMax - this.progress._height;
      }
      if(this.isModal)
      {
         this.updateModalWindow();
      }
      else
      {
         this.modalWindow._visible = false;
      }
      this.border_mc.border_down._y = Math.floor(_loc2_.yMax + 10) + 0.5;
      this.border_mc.border_middle._height = this.border_mc.border_down._y - this.border_mc.border_middle._y;
      this.adjustShadow();
   }
   function updateModalWindow()
   {
      if(this.isModal)
      {
         this.modalWindow._visible = true;
         this.modalWindow._width = Stage.width;
         this.modalWindow._height = Stage.height;
         var _loc2_ = new Object();
         _loc2_.x = this.border_mc._x;
         _loc2_.y = this.border_mc._y;
         this.localToGlobal(_loc2_);
         var _loc3_ = this._parent.getBounds(this.border_mc);
         this.modalWindow._x = - _loc2_.x + this.border_mc._x;
         this.modalWindow._y = - _loc2_.y + this.border_mc._y;
      }
   }
   function adjustContents()
   {
      var _loc2_ = new Object();
      _loc2_ = this.border_mc.border_up.getBounds(this);
      this.title_mc._y = Math.floor(_loc2_.yMin + 20);
      this.label_txt._y = Math.floor(this.title_mc._y + 16);
      this.progress._y = Math.ceil(this.label_txt._y + this.label_txt.textHeight + 5);
   }
   function accSize(size)
   {
      this.border_mc.border_up._y = (- size) / 2;
      this.border_mc.border_down._y = this.border_mc.border_up._y + this.border_mc.border_up._height + size;
      this.border_mc.border_middle._y = this.border_mc.border_up._y + this.border_mc.border_up._height;
      this.border_mc.border_middle._height = this.border_mc.border_down._y - this.border_mc.border_middle._y;
   }
   function __get__height()
   {
      return this.border_mc.border_down._y - this.border_mc.border_up._y - this.border_mc.border_up._height;
   }
   function adjustShadow()
   {
      this.shadow_mc.shadow_up._y = this.border_mc.border_up._y + 4;
      this.shadow_mc.shadow_down._y = this.border_mc.border_down._y + 4;
      this.shadow_mc.shadow_middle._height = this.border_mc.border_middle._height;
      this.shadow_mc.shadow_middle._y = this.border_mc.border_middle._y + 4;
   }
   function getSize()
   {
      return [this.border_mc._x,this.border_mc._y];
   }
   function setPosition(x, y)
   {
      this.modalWindow._width = 0;
      this.modalWindow._height = 0;
      this.modalWindow._x = this.border_mc._x;
      this.modalWindow._y = this.border_mc._y;
      this._x = Math.round(x - this.border_mc._x / 2);
      this._y = Math.round(y - this.border_mc._y / 2);
      this.updateModalWindow();
   }
}
