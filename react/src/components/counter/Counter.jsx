import React from 'react';
import Button from '../buttons/Button';
import './counter.css'

const Counter = ({ disableDecr, disableIncr, value, onChangeInput, onIncrement }) => {
    return (
        <div className = 'counter'>
            <Button
                onClick = {() => {onIncrement(-1)}}
                className = {disableDecr ? 'counter-button-disabled' : 'counter-button'}
                text = '-'
                disabled = {disableDecr}
            />
            <input
                value = {value}
                type = 'number'
                min = '0'
                className = 'counter-input'
                onChange = { onChangeInput }
            />
            <Button
                onClick = {() => {onIncrement(1)}}
                className = {disableIncr ? 'counter-button-disabled' : 'counter-button'}
                text = '+'
            />
        </div>
    );
};

export default Counter;