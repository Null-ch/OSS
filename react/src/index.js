import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App.jsx';
import { BrowserRouter, Routes, Route, Redirect, Outlet } from 'react-router-dom'
import { Provider } from 'react-redux';
import store from './store/index.js';

// обёртка в Provider позволит получить доступ к Store для всего приложения

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <Provider store = {store}>
        <App />
      </Provider>
    </BrowserRouter>
  </React.StrictMode>
);
