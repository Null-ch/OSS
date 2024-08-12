import React from 'react';
import './input.css';

const Input = ({ value, type = 'text', index, placeholder, inputList, onChange, error }) => {
    // console.log(inputList)
    return (
        <div className = { error ? 'input-container-error' : 'input-container' }>
            <input
                value = { value }
                tabIndex = { index }
                className = { error ? 'input-error' : 'input' }
                type = { type }
                placeholder = { placeholder }
                list = { inputList && 'input-list' }
                onChange = { onChange }
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

            {
                error
                &&
                <span className = 'input-abs-text'>{error}</span>
            }
        </div>
    );
};

export default Input;