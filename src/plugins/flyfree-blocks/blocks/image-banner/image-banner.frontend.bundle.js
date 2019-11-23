import { lazyLoadBackgroundImage } from '../../../../_common/scripts/lazyLoadBackgroundImage'

document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('[data-background]')
    images.forEach( image => {
        lazyLoadBackgroundImage(image)
    })
})