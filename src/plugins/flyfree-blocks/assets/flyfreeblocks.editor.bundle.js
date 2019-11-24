import './flyfreeblocks.editor.scss';

const hideEmptyBlocks = () => {
    const buttons = document.querySelectorAll('[aria-label="Add block"]');

    buttons.forEach( button => button.addEventListener('click', () => {
        setTimeout( () => {
            const list = document.querySelector('.editor-block-types-list');
            const children = list.querySelectorAll('li');

            children.forEach( child => {
                const btn = child.querySelector('button')
                
                if (btn.offsetParent === null) {
                    child.style.display = 'none';
                }
            })
        }, 50)
    }));
}

if (document.readyState !== 'loading') {
    hideEmptyBlocks();
}
else {
    document.addEventListener('DOMContentLoaded', () => hideEmptyBlocks() );
}