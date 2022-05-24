const smooth_scroll_btn = document.querySelector('#smooth_scroll_btn')
const main =  document.querySelector('.main')
main.addEventListener('scroll', function() {
    if(main.scrollTop >= 100) {
        smooth_scroll_btn.classList.remove('d-none')
    } else smooth_scroll_btn.classList.add('d-none')
})


smooth_scroll_btn.addEventListener('click', function() {
    main.scrollTo(0, 0)
})