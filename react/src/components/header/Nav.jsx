import Tab from './Tab';
import "./header.css"

let pages = [
    {to: '/', text: 'Home'},
    {to: '/shop', text: 'Shop'},
    {to: '/about', text: 'About'},
]

const Nav = () => {
    return (
        <div className = 'nav'>
            {pages.map(({to, text}, key) => {
                return <Tab key = {key} to = {to} text = {text}/>
            })}
        </div>
    );
};

export {Nav}