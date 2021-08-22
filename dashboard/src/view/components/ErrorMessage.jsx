import React from "react";

const ErrorMessage = ({ error, touched }) => {
    if (error && touched) {
        return <div className="mb-3" style={{ color: "white" }}>{error}</div>;
    } else {
        return <div className="mb-3"></div>;
    }
};

export default ErrorMessage;
