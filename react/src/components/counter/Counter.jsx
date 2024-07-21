import React from 'react';
import Button from '../buttons/Button';
import './counter.css'

const Counter = ({ disableDecr, disableIncr, value, onChangeInput, onIncrement, className, btnClassName, btnDisabledClassName }) => {
    // console.log(onChangeInput);
    return (
        <div className = {className}>
            <Button
                onClick = {() => {onIncrement(-1)}}
                className = {disableDecr ? btnDisabledClassName : btnClassName}
                text = '-'
                disabled = {disableDecr}
            />
            <input
                value = {value}
                type = 'number'
                min = '0'
                // className = 'counter-input'
                // onChange = { (e) => {console.log(e)} }
                inputMode = 'numeric'
                onInput = { (e) => {
                    let value = e.target.value || '0';
                    value = Number(value.replace(/\D+/g, ''));
                    e.target.value = value;
                    onChangeInput(value);
                } }
            />
            <Button
                onClick = {() => {onIncrement(1)}}
                className = {disableIncr ? btnDisabledClassName : btnClassName}
                text = '+'
                disabled = {disableIncr}
            />
        </div>
    );
};

export default Counter;