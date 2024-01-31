import React from 'react';
import { Routes, Route, Redirect } from 'react-router-dom'
import { publicRoutes } from '../routes';
import Home from '../pages/Home'

console.log(publicRoutes)
console.log(<Home></Home>)

const AppRouter = () => {
    return (
        <Routes>
            {publicRoutes.map(({path, component}) =>
                <Route key = {path} path = {path} element = {component} exact/>
            )}
        </Routes>
    );
};

export default AppRouter;