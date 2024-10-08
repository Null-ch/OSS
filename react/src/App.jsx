import React, {Suspense, useEffect, useState} from "react";
import './styles/reset.css'
import './styles/common.css'
import Layout from "./components/Layout";
import {publicRoutes} from './routes'
import {Route, Routes, useLocation} from 'react-router-dom'
import Header from './components/header/Header.jsx';
import Footer from './components/footer/Footer';
import Modal from "./components/modal/Modal";
import { setIsModalVisible } from './store/modalSlice';
import { setCartHidden, getCart, setCurrentProduct } from './store/cartSlice';
import { useDispatch, useSelector } from 'react-redux';
import NotFound from "./pages/util/NotFound.jsx";
import { Guid } from "js-guid";
import Cookies from 'js-cookie'
import { getCategories } from './store/categorySlice';
import { getDeliveries } from './store/deliverySlice';

function App() {
  Cookies.get('sessionID') || Cookies.set("sessionID", Guid.newGuid())
  //, { secure: true, SameSite: 'Strict' }); // todo expires, path

  const dispatch = useDispatch();
  const location = useLocation();
 
  // always:
  useEffect(() => {
      dispatch(setIsModalVisible(false));
      dispatch(setCartHidden(true));
    }, [location]);

  // once:
  useEffect(() => {
    dispatch(getCart());
    dispatch(getCategories());
    dispatch(getDeliveries());
  }, []);

  const { isModalVisible, content } = useSelector((state) => state.modal);

  return (
    <>
      <Header/>

      <Routes>
        <Route path = "/" element = {<Layout/>}>
          {publicRoutes.map(({path, component}) =>
          {
            const element = <Suspense>{component}</Suspense>
            if (path === "/") {
              return <Route key = {path} index element = {element} exact/>
            } else {
              return <Route key = {path} path = {path} element = {element} exact/>
            }
          }    
          )}
        </Route>
        <Route path = "*" element = {<NotFound/>}/>
      </Routes>

      <Footer/>

      <Modal
            isActive = { isModalVisible }
            content = { content }
            onBackgroundClick = {() => {
              dispatch(setIsModalVisible(false));
            }}
        />
    </>
  );
}

export default App;
