var f = {
    tip: function(msg, time) {
        var tipContainer = document.querySelector('.f-tip-in');
        
        if (!tipContainer) {
            tipContainer = document.createElement('div');
            tipContainer.className = 'f-tip-in';
            document.body.appendChild(tipContainer);
        }
        
        var tipDiv = document.createElement('div');
        tipDiv.className = 'f-tip';
        tipDiv.innerHTML = msg;
        
        // 点击关闭按钮
        tipDiv.addEventListener('click', function(event) {
            if (event.target.classList.contains('f-tip-close')) {
                tipDiv.classList.add('f-tip-out');
                setTimeout(function() {
                    tipContainer.removeChild(tipDiv);
                }, 500);
            }
        });
        
        tipContainer.insertBefore(tipDiv, tipContainer.firstChild);
        
        if (time) {
            setTimeout(function() {
                tipDiv.classList.add('f-tip-out');
                setTimeout(function() {
                    tipContainer.removeChild(tipDiv);
                }, 500);
            }, time * 1000);
        }
    }
};
