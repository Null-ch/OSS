import React from 'react';
import Button from '../buttons/Button';
import './counter.css'

const Counter = ({ disableDecr, disableIncr, value, onChangeInput, onIncrement, className, btnClassName, btnDisabledClassName }) => {
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
                onChange = { onChangeInput }
            />
            <Button
                onClick = {() => {onIncrement(1)}}
                className = {disableIncr ? btnDisabledClassName : btnClassName}
                text = '+'
            />
        </div>
    );
};

export default Counter;