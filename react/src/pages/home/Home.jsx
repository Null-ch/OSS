import React from 'react';
import Offers from './offers/Offers';
import Categories from './categories/Categories';
import soapImg from './../../img/soap1.jpg'

import './home.css'

// todo передавать офферы извне
// todo передавать категории извне

const Home = () => {
    return (
        <main className = 'main-page'>
            {/* <Offers items = {[
                { src:soapImg }
                ]}/> */}
            <Categories/>
        </main>
    );
};

export default Home;