import React from 'react';
import Offers from './Offers';

import soapImg from './../../img/soap1.jpg'

const Home = () => {
    return (
        <div>
            <Offers items = {[
                { src:soapImg }
                ]}/>
        </div>
    );
};

export default Home;