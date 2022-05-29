'use strict'
class WJet{
    selector;
    dom;
    constructor(selector){

        if(typeof selector === 'object' && selector.nodeType == 1){
            this.selector = selector;
        }

        if(typeof selector === 'string' || typeof selector instanceof String) {
            this.selectorString = selector
            this.selector = document.querySelector(selector);
        }
    }

    WFor(callback) {
        document.querySelectorAll(this.selectorString).forEach((el,index,array) => callback({
            el,
            index,
            array,
        }))
    }

    val(val) {
        if(val == '' || val){
             this.selector.value = val
             return this;
        }
       return this.selector.value
    }

    attr(atr,val=null) {
        if(val) {
            this.selector.setAttribute(atr,val)
            return this
        }
        this.selector.getAttribute(atr)
        return this
    }

    hasClass(cls) {
       return this.selector.classList.contains(cls)
    }

    html(val) {
        this.selector.innerHTML = val;
    }

    click(){
        this.selector.click()
    }

    remove() {
        this.selector.remove()
    }

    addClass(cls) {
        this.selector.classList.add(cls)
        return this
    }

    on(event,callback) {
        this.selector.addEventListener(event,function(event){
            let target = event.target;
            callback({
                event,
                el:target,
                id:target.id,
                value:target.value,
                html: val => target.innerHTML = val,
                hasClass:cls => target.classList.contains(cls),
                toggleClass:cls => target.classList.toggle(cls),
                addClass:cls => target.classList.add(cls),
                removeClass:cls => target.classList.remove(cls),
                toggleAttr:(name,val) => target.getAttribute(name) ? target.removeAttribute(name) : target.setAttribute(name,val),
            })
        })
    }
    toggleClass(cls){
        this.selector.classList.toggle(cls)
    }
    checked(condition) {
        this.selector.checked = condition;
    }

    attrRemove(atr){
        this.selector.removeAttribute(atr)
    }
}

window.W = function(selector){
    return new WJet(selector)
}


class Jet {
    constructor(promise) {
        this.promise = promise
    }

    done(callback){
       this.promise = this.promise.then(res => {
            callback(res)
            return res.data
       })
       return this
    }
    
    fail(callback) {
            this.promise = this.promise.catch(err => callback(err))
    }
}

WJet.get = function(url){
    return new Jet(
        fetch(url)
        .then(res => {
            if(res.ok){
                return res.json()
            }
            throw res.status
        })
    )
}





