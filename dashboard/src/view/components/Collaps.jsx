import { useRef, useState } from "react";

const Collaps = ({ indexData, colllapsData }) => {
    const content = useRef(null);
    const [status, setStatus] = useState(false);
    return (
        <>
            <span onClick={(e) => {
                if (status) {
                    content.current.style.maxHeight = "0px";
                } else {
                    content.current.style.maxHeight = content.current.scrollHeight + "px";
                }
                setStatus(!status);
            }}>
                {indexData(status)}
            </span>
            <div className="content" ref={content} >
                {colllapsData}
            </div>
        </>

    );
}

export default Collaps;
