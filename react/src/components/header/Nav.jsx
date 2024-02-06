import Tab from './Tab';
import "./header.css"
import { nav } from '../../routes';


let pages = [
    {to: '/', text: 'Home'},
    {to: '/shop', text: 'Shop'},
    {to: '/about', text: 'About'},
]

const Nav = () => {
    return (
        <div className = 'nav'>
            {nav.map(({path, title}, key) => {
                return <Tab key = {key} path = {path} title = {title}/>
            })}
        </div>
    );
};

export {Nav}