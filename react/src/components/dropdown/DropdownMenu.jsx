import React from 'react';
import "./dropdown.css"

const DropdownMenu = ({ list }) => {
    list = list || []
    return (
        <ul className="dropdown-menu">
            <li className="dropdown-menu-item">
                {/* <button className="dropdown-menu-btn">Пункт 1</button> */}
                <div className="dropdown">
                    <ul className="dropdown-list">
                        <li className="dropdown-item">
                            {list.map(({path, title}, key) => {
                                return <a key = {key} href={path} className="dropdown-link">{title}</a>   
                            })}
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    );
};

export default DropdownMenu;