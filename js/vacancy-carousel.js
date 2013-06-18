(function($){
        $.fn.my_carousel = function(options) {
                // дефолтные настройки
                var settings = {
                        visible: 3,
                        rotateBy: 1,
                        speed: 800,
                        btnNext: null,
                        btnPrev: null,
                        auto: null,
                        backSlide: false
                };
                
                return this.each(function() {
                        if (options) {
                                $.extend(settings, options);
                        }
                        
                        // определяем "глобальные" переменные
                        var $this = $(this);
                        var $carousel = $this.children(':first');
                        var itemWidth = $carousel.children().outerWidth();
                        var itemsTotal = $carousel.children().length;
                        var running = false;
                        var intID = null;
                        
                        // присваиваем необходимые стили для элементов карусели
                        // сначала для контейнера
                        $this.css({
                                'position': 'relative', // необходимо для нормального отображения в ИЕ6(7)
                                'overflow': 'hidden', // прячем все, что не влезает в контейнер
                                'width': settings.visible * itemWidth + 'px' // ширину контейнера ставим равной ширине всех видимых элементов
                        });
                        
                        // потом для внутреннего элемента (в нашем случае <ul>)
                        $carousel.css({
                                'position': 'relative', // относительное позиционирование нужно для того, чтобы можно было использовать сдвиг влево
                                'width': 32767 + 'px', // ставим ширину побольше, чтобы точно влезли все элементы
                                'left': 0 // устанавливаем нулевой левый сдвиг
                        });
                        
                        // параметр dir(boolean) - false(сдедующий), true(предыдущий)
                        function slide(dir) {
                                var direction = !dir ? -1 : 1; // выбираем направление в зависимости от переданного параметра (влево или вправо)
                                var leftIndent = 0; // левое смещение (для <ul>)
                                
                                if (!running) { // если анимация завершена (или еще не запущена)
                                        running = true; // ставим флажок, что анимация в процессе
                                        
                                        if (intID) { // если запущен интервал
                                                window.clearInterval(intID); // очищаем интервал
                                        }
                                        
                                        if (!dir) { // если мы мотаем к следующему элементу (так по умолчанию)
                                                /*
                                                * вставляем после последнего элемента карусели
                                                * клоны стольких элементов, сколько задано
                                                * в параметре rotateBy (по умолчанию задан один элемент)
                                                */
                                                $carousel.children(':last').after($carousel.children().slice(0, settings.rotateBy).clone(true));
                                        } else { // если мотаем к предыдущему элементу
                                                /*
                                                * вставляем перед первым элементом карусели
                                                * клоны стольких элементов, сколько задано
                                                * в параметре rotateBy (по умолчанию задан один элемент)
                                                */
                                                $carousel.children(':first').before($carousel.children().slice(itemsTotal - settings.rotateBy, itemsTotal).clone(true));
                                                
                                                /*
                                                * сдвигаем  карусель  (< ul >) влево на ширину элемента,
                                                * умноженную на количество элементов, заданных
                                                * в параметре rotateBy (по умолчанию задан один элемент)
                                                */
                                                $carousel.css('left', -itemWidth * settings.rotateBy + 'px');
                                        }
                                        
                                        /*
                                        * расчитываем левое смещение
                                        * текущее значение left + ширина одного элемента * количество проматываемых элементов * на направление перемещения (1 или -1)
                                        */
                                        leftIndent = parseInt($carousel.css('left')) + (itemWidth * settings.rotateBy * direction);
                                        
                                        // запускаем анимацию
                                        $carousel.animate({'left': leftIndent}, {queue: false, duration: settings.speed, complete: function() {
                                                // когда анимация закончена
                                                if (!dir) { // если мы мотаем к следующему элементу (так по умолчанию)
                                                        // удаляем столько первых элементов, сколько задано в rotateBy
                                                        $carousel.children().slice(0, settings.rotateBy).remove();
                                                        // устанавливаем сдвиг в ноль
                                                        $carousel.css('left', 0);
                                                } else { // если мотаем к предыдущему элементу
                                                        // удаляем столько последних элементов, сколько задано в rotateBy
                                                        $carousel.children().slice(itemsTotal, itemsTotal + settings.rotateBy).remove();
                                                }
                                                
                                                if (settings.auto) { // если карусель должна проматываться автоматически
                                                        // запускаем вызов функции через интервал времени (auto)
                                                        intID = window.setInterval(function() { slide(settings.backslide); }, settings.auto);
                                                }
                                                
                                                running = false; // отмечаем, что анимация завершена
                                        }});
                                }
                                
                                return false; // возвращаем false для того, чтобы не было перехода по ссылке
                        }
                        
                        // назначаем обработчик на событие click для кнопки next
                        $(settings.btnNext).click(function() {
                                return slide(false);
                        });
                        
                        // назначаем обработчик на событие click для кнопки previous
                        $(settings.btnPrev).click(function() {
                                return slide(true);
                        });
                        
                        if (settings.auto) { // если карусель должна проматываться автоматически
                                // запускаем вызов функции через временной интервал
                                intID = window.setInterval(function() { slide(settings.backslide); }, settings.auto);
                        }
                });
        };
})(jQuery);
