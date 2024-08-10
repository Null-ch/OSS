import React from 'react';

const Modal = ({isActive, onClose, content}) => {
    return (
        <>
            {isActive && (
                <div className = 'modal' onClick = {onClose}>
                    {content}
                </div>)
            }
        </>

    );
};

export default Modal;