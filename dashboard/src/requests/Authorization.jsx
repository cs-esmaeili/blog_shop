import http from "./httpServices";
import statics from "../statics.json";

export const login = (data) => {
    return http.post(`${statics.api_url}login`, JSON.stringify(data));
};

export const LogOut = (data) => {
    return http.post(`${statics.api_url}logout`, JSON.stringify(data));
};
export const _ChangeData = (data) => {
    return http.post(`${statics.api_url}changedata`, JSON.stringify(data), {
        headers: {
            "Action": "changeData",
        }
    });
};
