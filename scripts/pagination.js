export function pagination(e) {
    if (e.target.classList.contains('load-more-button')) {
        e.preventDefault();
        const container = document.querySelector('.site-content');
        const postList = container.querySelector('.post-list');
        const oldLink = container.querySelector('.load-more-button');
        const url = e.target.href;

        fetch(url).then((response) => {
            response.text().then(content => {;
                const tmp = document.createElement('div');
                tmp.innerHTML = content;
                const newPosts = tmp.querySelector('.post-list').querySelectorAll('.post');
                const newLink = tmp.querySelector('.load-more-button');
                
                container.removeChild(oldLink);
                if (newLink) container.appendChild(newLink);
                
                [...newPosts].forEach((post) => {
                    postList.appendChild(post);
                });
            });
        });
    }
}
