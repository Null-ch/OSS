import React from 'react';
import './footer.css'

let titleClass = 'footer-section-title'
let itemClass = 'footer-section-item'
let sectionClass = 'footer-section'

const Section = ({title}) => {
    return (
        <div className={sectionClass}>
            <span className={titleClass}>{title}</span>
            <span className={itemClass}>Item</span>
            <span className={itemClass}>Item</span>
            <span className={itemClass}>Item</span>
            <span className={itemClass}>Item</span>
        </div>
    );
};

export default Section;