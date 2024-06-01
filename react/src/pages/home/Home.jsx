import React from 'react';
import Offers from './offers/Offers';
import Categories from './categories/Categories';

import soapImg from './../../img/soap1.jpg'

// todo передавать офферы извне
// todo передавать категории извне

const Home = () => {
    return (
        <main>
            {/* <Offers items = {[
                { src:soapImg }
                ]}/> */}
            <Categories/>
        </main>
    );
};

export default Home;