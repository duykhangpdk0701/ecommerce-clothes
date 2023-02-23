import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";
import Image from "next/image";
import React, { ChangeEventHandler, FC, useEffect } from "react";
import { useDropzone } from "react-dropzone";
import fileImage from "@/assets/images/file.svg";
import { LazyLoadImage } from "react-lazy-load-image-component";

interface IDropzone {
  multiple?: boolean;
  onChange?: ChangeEventHandler<HTMLInputElement>;
  error?: boolean;
}

const Dropzone: FC<IDropzone> = ({ multiple, onChange, error, ...rest }) => {
  const { acceptedFiles, getRootProps, getInputProps } = useDropzone({
    multiple,
    ...rest,
  });

  useEffect(() => {
    if (onChange) {
      if (multiple) {
        onChange(acceptedFiles as any);
      } else {
        onChange(acceptedFiles?.[0] as any);
      }
    }
  }, [acceptedFiles]);

  return (
    <>
      <Box
        {...getRootProps()}
        className={`block p-10 border-dashed border ${
          error ? `border-red-400 bg-orange-100` : `border-gray-300 bg-gray-100`
        } rounded `}
      >
        <input {...getInputProps()} />
        <div className="flex gap-10 items-center">
          <div className="basis-56 object-cover">
            <Image className="h-auto w-full" src={fileImage} alt="file" />
          </div>
          <div>
            <Typography
              variant="h5"
              className={error ? `text-red-500` : undefined}
            >
              Drop or Select file
            </Typography>
            <Typography variant="body2">
              Drop files here or click
              <span className="mx-1 text-blue-600 underline">browse</span>
              throug your machine
            </Typography>
          </div>
        </div>
      </Box>
      {acceptedFiles.length !== 0 && (
        <Box className="my-6 flex">
          {acceptedFiles.map((file) => (
            <div className="m-1 relative w-20 h-20">
              <LazyLoadImage
                src={URL.createObjectURL(file)}
                alt="file"
                className="h-full object-cover"
              />
            </div>
          ))}
        </Box>
      )}
    </>
  );
};

export default Dropzone;
