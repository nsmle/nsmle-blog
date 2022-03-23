function changeEditorTheme() {
    //let location = window.location.href;
    let toastUiViewers = document.querySelectorAll('.toastui-editor-contents');
    let toastUiEditor = document.querySelector('.toastui-editor-defaultUI');
    //let comments = document.querySelectorAll('.content-comment');
    
    /*
    if (location.search(/\/dashboard\/post\/(.*?)\/([edit])/i) > 0) {
        toastUi = document.querySelector('#editor');
    } else if (location.search(/\/dashboard\/post\/create/i) > 0) {
        toastUi = document.querySelector('#editor');
    } else if (location.search(/\/post\//i) > 0) {
        toastUi = document.querySelector('#content');
    }
    */
    
    if (!!toastUiViewers) {
        if (!('theme' in localStorage) || localStorage.theme === 'light') {
            
            toastUiViewers.forEach((toastUi) => {
                toastUi.parentNode.classList.remove('toastui-editor-dark');    
            });
            
        
            (!!toastUiEditor) ? toastUiEditor.classList.remove('toastui-editor-dark') : '';
            
        } else {
            
            toastUiViewers.forEach((toastUi) => {
                toastUi.parentNode.classList.add('toastui-editor-dark');
            });
            
            (!!toastUiEditor) ? toastUiEditor.classList.add('toastui-editor-dark') : '';
            
        }
    }
    
}





document.addEventListener('scroll', (e) => {
    let nav = document.querySelector('nav');
    let navBtm = document.querySelector("#bottom-navigation")
    if (this.scrollY > 30) {
        (!!nav) ? nav.classList.add('drop-shadow-md', 'bg-neutral-100', 'dark:bg-midnight-300') : '';
        if (this.oldScroll > this.scrollY) {
            //up
            if (!!nav) {
                nav.classList.add('show-top');
                nav.classList.remove('hide-top');
            }
            if (!!navBtm) {
                navBtm.classList.add("show-bottom")
                navBtm.classList.remove("hide-bottom")
            }
        } else {
            //down
            if (!!nav) {
                nav.classList.add('hide-top');
                nav.classList.remove('show-top');
            }
            if (!!navBtm) {
                navBtm.classList.add("hide-bottom")
                navBtm.classList.remove("show-bottom")
            }
        }
        this.oldScroll = this.scrollY;
    } else {
        (!!nav) ? nav.classList.remove('drop-shadow-md', 'bg-neutral-100', 'dark:bg-midnight-300') : '';
        //open = false;
    }
});


window.navOpen = () => {
    return {
        navOpen: false
    }
}

// let metaThemeColor = [
//     {
//         'name' : 'theme-color',
//         'content': {
//             'light': '#f3f6fe',
//             'dark': '#131d36'
//         }
//     },
//     {
//         'name' : 'msapplication-navbutton-color',
//         'content': {
//             'light': '#f3f6fe',
//             'dark': '#131d36'
//         }
//     },
//     {
//         'name' : 'apple-mobile-web-app-status-bar-style',
//         'content': {
//             'light': '#f3f6fe',
//             'dark': '#131d36'
//         }
//     },
// ];

function changeThemeColor() {
    let themeLists = ['theme-color', 'msapplication-navbutton-color', 'apple-mobile-web-app-status-bar-style'];
    themeLists.forEach((theme) => {
        let themeColor = document.querySelector(`meta[name="${theme}"]`);
        if (!!themeColor) {
            if (localStorage.theme === 'dark') {
                themeColor.setAttribute('content', '#1b2a4e');
            } else {
                themeColor.setAttribute('content', '#e6eaf7');
            }
        }
    });
}

//document.getElementsByTagName('head')[0].appendChild(meta);

// metaThemeColor.forEach((metaColor) => {
//     console.log(metaThemeColor.indexOf(metaColor))
//     let meta = document.createElement('meta');
//     meta.name = metaColor.name;
//     meta.content = metaColor.content[localStorage.theme]
// });
// console.log(metaThemeColor)



window.darkmode = function () {
    return {
        setTheme(theme) {
          localStorage.setItem('theme', theme);
        },
        changeTheme() {
            if (localStorage.getItem('theme')) {
                if (localStorage.getItem('theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
        
                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }
            
            changeEditorTheme();
            changeThemeColor();
            return localStorage.theme;
        }
    };
}







Livewire.on("darkmode", function () {
    alert('ok')
});
