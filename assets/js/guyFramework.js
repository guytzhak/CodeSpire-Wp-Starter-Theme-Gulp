/** Helpers **/

/* debounce - This feature enforces a function call to not happen until some time has passed since it’s last call. For example, call the function if 100 millisecond has passed from it’s last call. */
var debounce = (func, delay) => {
    let inDebounce;
    return function() {
        var context = this;
        var args = arguments;
        clearTimeout(inDebounce);
        inDebounce = setTimeout(() => func.apply(context, args), delay);
    };
};

/* Lazyload */

document.addEventListener('DOMContentLoaded', function() {
    var lazyloadImages;

    if ('IntersectionObserver' in window) {
        lazyloadImages = document.querySelectorAll('.lazy');
        var imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var image = entry.target;
                    image.src = image.dataset.src;
                    image.classList.remove('lazy');
                    imageObserver.unobserve(image);
                }
            });
        });

        lazyloadImages.forEach(function(image) {
            imageObserver.observe(image);
        });
    } else {
        var lazyloadThrottleTimeout;
        lazyloadImages = document.querySelectorAll('.lazy');

        var guyLazyLoad = debounce(function() {
            if (lazyloadThrottleTimeout) {
                clearTimeout(lazyloadThrottleTimeout);
            }

            lazyloadThrottleTimeout = setTimeout(function() {
                var scrollTop = window.pageYOffset;
                lazyloadImages.forEach(function(img) {
                    if (img.offsetTop < window.innerHeight + scrollTop) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                    }
                });
                if (lazyloadImages.length == 0) {
                    document.removeEventListener('scroll', guyLazyLoad);
                    window.removeEventListener('resize', guyLazyLoad);
                    window.removeEventListener('orientationChange', guyLazyLoad);
                }
            }, 20);
        }, 200);

        document.addEventListener('scroll', guyLazyLoad);
        window.addEventListener('resize', guyLazyLoad);
        window.addEventListener('orientationChange', guyLazyLoad);
    }
});

