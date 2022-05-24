/**
 * 
 * @param {String} element 
 * @param {boolean} many 
 * @returns HTMLElement
 */
const $ = (element, many = false) => many ? document.querySelectorAll(element) : document.querySelector(element)

const edit__category__btns = Array.from($('.edit__category__btn', true))
const delete__category__btns = Array.from($('.delete__category__btn', true))
const delete__dish__btns = Array.from($('.delete__dish__btn', true))
const edit__category__form = $('#edit__category__form')
const delete__category__form = $('#delete__category__form')
const delete__dish__form = $('#delete__dish__form')
const categoryId = $('#categoryId')
const category = $('#category')
const modalCategoryName = $('#modalCategoryName')
const modalDishName = $('#modalDishName')
const edit__dish__btns = Array.from($('.edit__dish__btn', true))
const edit__dish__form = $('#edit__dish__form')
//Dish edit forms fields

const dish__name__edit__input = edit__dish__form.querySelector('#dishName')
const dish__desc__edit__input = edit__dish__form.querySelector('#description')
const dish__id__edit__input = edit__dish__form.querySelector('#dishId')
const dish__pictures__bloc = edit__dish__form.querySelector('#dishModalImgBloc')

edit__category__btns.forEach(edit__category__btn => {
    const data = JSON.parse(edit__category__btn.dataset.categorydata)
    edit__category__btn.addEventListener('click', function () {
        categoryId.setAttribute('value', data.id)
        category.setAttribute('value', data.name)
    })
})

delete__category__btns.forEach(delete__category__btn => {
    const data = JSON.parse(delete__category__btn.dataset.categorydata)
    delete__category__btn.addEventListener('click', function () {
        modalCategoryName.innerHTML = `"${data.name}"`
        delete__category__form.setAttribute('action', data.route)
    })
})

delete__dish__btns.forEach(delete__dish__btn => {
    console.log(delete__dish__btn.dataset.dishdata);
    const data = JSON.parse(delete__dish__btn.dataset.dishdata)
    delete__dish__btn.addEventListener('click', function () {
        modalDishName.innerHTML = `"${data.name}"`
        delete__dish__form.setAttribute('action', data.route)
    })
})

edit__dish__btns.forEach(async (edit__dish__btn) => {
    const route = edit__dish__btn.dataset.route;
    const response = await fetch(route)
    const { id, name, categoryId, description, picture1, picture2, picture3 } = await response.json()
    const picturesNames = [picture1, picture2, picture3].filter(pic => pic != null)
    const pictures = picturesNames.map(picName => {
        const img = new Image(75, 75)
        img.src = `${window.location.origin}/storage/dishes/${picName}`
        return img.outerHTML
    })
    edit__dish__btn.addEventListener('click', _ => {
        dish__name__edit__input.value = name
        document.querySelector(`option[value='${categoryId}']`).setAttribute('selected', 'true')
        dish__desc__edit__input.innerHTML = description
        dish__id__edit__input.value = id
        dish__pictures__bloc.innerHTML = pictures.join('')
    })
})