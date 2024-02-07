import React, {useState, useContext} from "react";
import { Context } from "../util/context";


const Button = ({text, route}) => {
    const {logIn, logOut} = useContext(Context)

    return (
        <Context.Provider value = '1'>
            <a href={route}>
                <button type = 'button' onClick = {() => { 
                    if (route === '/login') {
                        logIn()
                    } else {
                        logOut()
                    }
                }}>
                    <span>
                        {text}
                    </span>
                </button>
            </a>

        </Context.Provider>
    );
};

export default Button;