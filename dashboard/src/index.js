import React from "react";
import ReactDOM from "react-dom";
import Index from "./view/Index";
import { BrowserRouter } from "react-router-dom";
import { Provider } from "react-redux";
import { store } from "./redux/store/index";
import 'bootstrap/dist/css/bootstrap.min.css';

ReactDOM.render(
    <Provider store={store}>
        <BrowserRouter>
            <Index />
        </BrowserRouter>
    </Provider>,
    document.getElementById("root")
);
