import {React, useEffect, useState, useRef} from 'react';
import {Link} from 'react-router-dom'
import "./header.css"
import ArrowIcon from '../icons/ArrowIcon';
import DropdownMenu from '../dropdown/DropdownMenu';

const Tab = ({path, title, list, onClick, className }) => {
    // todo при выборе категории в Продуктах перезагружается страница, выяснить почему

    // на мой взгляд выглядит всрато, не придумал как лучше - мы N (кол-во табов) лишних раз подпишемся
    // на события с разными данными, вести они себя будут по-разному и желаемый результат будет перекрываться
    // нежелаемым. Альтернатива - вынести всё в родителя (Nav.jsx) и передавать сюда  рефы, стейты и пр., что грязно

    const [isOpened, setIsOpened] = useState(false);
    const dropdownButtonRef = useRef();
    const dropdownMenuRef = useRef();

    function handleOutsideClick(e) {
        if ( dropdownMenuRef.current && !dropdownMenuRef.current.contains(e.target)
            && e.target !== dropdownButtonRef.current
        ) {
            // console.log('close');
            if (!isOpened) {
                // console.log(isOpened);
                setIsOpened(false);
            }

        }
        // todo вспомнить нахуя я добавил это (ломает любой клик\выделение на странице)
        // if (e.preventDefault) { e.preventDefault(); }
    }

    useEffect(() => {
        // console.log(isOpened);
        }, [isOpened])

    useEffect(() => {
        document.addEventListener('mousedown', handleOutsideClick);
        return () => { document.removeEventListener('mousedown', handleOutsideClick); };
      }, []);

    return (
        <>
            {
                list ?
                <details
                    ref={dropdownMenuRef}
                    className = {className}
                    open = {isOpened}
                    onToggle = {(e)=>{setIsOpened(e.currentTarget.open)}}>
                    <summary ref={dropdownButtonRef} className = 'tab-title'>
                        <span>{title}</span>
                        <ArrowIcon
                            className = 'arrow-hover'
                            rotate = '0'
                            width = '16'
                            height = '16'
                            fillColor = '#f7f7f7'
                        />
                    </summary>
                    <DropdownMenu list = {list}/>
                </details>
                :
                <Link className = {className} to = {path} onClick = { list ? null : onClick}>
                    <div className = 'tab-title'>
                        <span>{title}</span>
                    </div>
                </Link>
            }
        </>
    );
};

export default Tab;