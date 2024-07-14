import React from 'react';
import './input.css';

const Input = ({ type, index, placeholder, inputList, onChange }) => {
    // console.log(inputList)
    return (
        <div>
            <input
                tabIndex = {index}
                className = 'input'
                type={type}
                placeholder = {placeholder}
                list = { inputList && 'input-list' }
                onChange={ onChange }
            />
            
            {
                inputList
                &&
                <datalist id = 'input-list'>
                    {
                        inputList.map((value, key) => {
                            return <option key = {key} value = {value}/>
                        })
                    }
                </datalist>
            }

        </div>
    );
};

export default Input;