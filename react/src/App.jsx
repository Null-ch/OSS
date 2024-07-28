import React, {Suspense, useEffect, useState} from "react";
import './styles/reset.css'
import './styles/common.css'
import Layout from "./components/Layout";
import {publicRoutes} from './routes'
import {Route, Routes, useLocation} from 'react-router-dom'
import Header from './components/header/Header.jsx';
import Footer from './components/footer/Footer';
import Modal from "./components/modal/Modal";
import { setIsModalVisible, setModalData, setContent } from './store/modalSlice';
import { setCartHidden, getCart } from './store/cartSlice';
import { useDispatch, useSelector } from 'react-redux';
import NotFound from "./pages/util/NotFound.jsx";
import { Guid } from "js-guid";
import Cookies from 'js-cookie'

// import { randomUUID } from "crypto";

// todo Guid.newGuid()

function App() {
  // const isLogged = localStorage.getItem('isLoggedIn');
  // const [loggedIn, setLoggedIn] = useState(isLogged);

  // const logIn = () => {
  //   localStorage.setItem('isLoggedIn', JSON.stringify(true));
  //   setLoggedIn(true);
  // }

  // const logOut = () => {
  //   localStorage.setItem('isLoggedIn', JSON.stringify(false));
  //   setLoggedIn(false);
  // }

  // todo cookies
  Cookies.get('sessionID') || Cookies.set("sessionID", Guid.newGuid())
   //, { secure: true, SameSite: 'Strict' }); // todo expires, path

  const dispatch = useDispatch();
  const location = useLocation();
  useEffect(() => {
      dispatch(setIsModalVisible(false));
  }, [location]);

  useEffect(() => {
      // execute on location change
      dispatch(setCartHidden(true));
  }, [location]);

  // todo test:
  const data = dispatch(getCart());
  // console.log('getCart');
  // console.log(data);

  const {isModalVisible, content} = useSelector((state) => state.modal);

  window.onscroll = function() { scrollFunction() };

  function scrollFunction() {
    // if (document.body.scrollTop > 24 || document.documentElement.scrollTop > 24) {
    //   document.getElementById("header").className = 'header-fixed';
    // } else {
    //   document.getElementById("header").className = 'header';
    // }
  }
  
  // window.localStorage.clear();

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
            isActive = {isModalVisible}
            content = {content}
            onClose={() => {
              dispatch(setIsModalVisible(false));
            }}
        />
    </>
  );
}

export default App;
