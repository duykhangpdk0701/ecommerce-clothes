import IProduct from "@/interfaces/Product";
import { IProductDetailParams } from "@/pages/product/[slug]";

import Button from "@mui/material/Button";
import Container from "@mui/material/Container";
import Grid from "@mui/material/Grid";
import Typography from "@mui/material/Typography";
import Rating from "@mui/material/Rating";
import RadioGroup from "@mui/material/RadioGroup";
import Radio from "@mui/material/Radio";

import CircleIcon from "@mui/icons-material/Circle";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";
import RemoveIcon from "@mui/icons-material/Remove";
import AddIcon from "@mui/icons-material/Add";

import { sentenceCase } from "change-case";
import React, { useState, useRef, useEffect, FC } from "react";
import {
  Control,
  SubmitHandler,
  UseFormHandleSubmit,
} from "react-hook-form/dist/types";
import Slider from "react-slick";
import { Controller } from "react-hook-form";
import { Box } from "@mui/material";
import { LazyLoadImage } from "react-lazy-load-image-component";

interface IProductContent {
  control: Control<IProductDetailParams, any>;
  handleSubmit: UseFormHandleSubmit<IProductDetailParams>;
  onSubmit: SubmitHandler<IProductDetailParams>;
  itemDetail?: IProduct;
  isLoading: boolean;
}

const ProductContent: FC<IProductContent> = (props) => {
  const { control, itemDetail, handleSubmit, onSubmit, isLoading } = props;
  const slider1Ref = useRef<Slider>();
  const slider2Ref = useRef<Slider>();

  const [nav1, setNav1] = useState();
  const [nav2, setNav2] = useState();
  useEffect(() => {
    [slider1Ref.current, slider2Ref.current] = [
      slider2Ref.current,
      slider1Ref.current,
    ];
  });

  return (
    <Container>
      <Grid container spacing={3}>
        <Grid item xs={6}>
          <div>
            <Slider
              dots
              slidesToShow={1}
              asNavFor={nav2}
              ref={(slider) => setNav1(slider as any)}
              adaptiveHeight
              className="mb-7"
            >
              {itemDetail?.media.map((item) => (
                <div
                  key={item.id}
                  className="h-[400px] w-full flex justify-center"
                >
                  <div className="w-full h-full bg-[#f1f1f1]">
                    <LazyLoadImage
                      src={item.url}
                      className="object-contain h-full mx-auto"
                    />
                  </div>
                </div>
              ))}
            </Slider>
            <Slider
              asNavFor={nav1}
              ref={(slider) => setNav2(slider as any)}
              slidesToShow={5}
              swipeToSlide={true}
              focusOnSelect={true}
              adaptiveHeight
            >
              {itemDetail?.media.map((item) => (
                <div key={item.id} className="h-[100px]">
                  <LazyLoadImage key={item.id} src={item.url} />
                </div>
              ))}
            </Slider>
          </div>
        </Grid>

        <Grid item xs={6}>
          <form onSubmit={handleSubmit(onSubmit)}>
            <Typography variant="h1" className="text-3xl font-bold mb-2">
              {itemDetail && sentenceCase(itemDetail.name)}
            </Typography>
            <div className="flex mb-2 items-baseline">
              <div className="text-sm text-color-gray">Brand: </div>{" "}
              <h6 className="text-sm font-medium">
                {itemDetail && sentenceCase(itemDetail.brand.name)}
              </h6>
            </div>
            <div className="flex mb-2 items-center">
              <div className="text-sm text-color-gray">Rate:</div>
              <Rating
                size="small"
                name="read-only"
                className="mx-1"
                value={5}
                readOnly
              />
            </div>
            <div className="pt-2 mb-6">
              <div className="mb-4">
                <Typography variant="h6" className="mb-2 text-sm font-semibold">
                  Color
                </Typography>
                <Controller
                  name="itemColor"
                  control={control}
                  render={({ field: { value, onChange } }) => (
                    <div className="flex gap-3">
                      {itemDetail?.colors?.map((item) => (
                        <Box
                          className={`h-9 w-9 rounded-full flex justify-center items-center border-2 ${
                            value === item.id
                              ? "border-color-price"
                              : "border-gray-400"
                          } border-solid cursor-pointer hover:border-color-price transition-all`}
                          onClick={() => onChange(item.id)}
                        >
                          <Box
                            sx={{
                              bgcolor: item.value,
                            }}
                            className={`h-7 w-7 rounded-full`}
                          ></Box>
                        </Box>
                      ))}
                    </div>
                  )}
                />
              </div>

              <div className="mb-4">
                <Typography variant="h6" className="mb-2 text-sm font-semibold">
                  Size
                </Typography>
                <Controller
                  name="itemSize"
                  control={control}
                  render={({ field: { value, onChange } }) => (
                    <div className="flex gap-3">
                      {itemDetail?.sizes.map((item) => (
                        <Button
                          onClick={() => onChange(item.id)}
                          variant={value === item.id ? "contained" : "outlined"}
                        >
                          {item.value}
                        </Button>
                      ))}
                    </div>
                  )}
                />
              </div>
              <div className="mb-4">
                <Typography variant="h6" className="mb-2 text-sm font-semibold">
                  Quantity
                </Typography>
                <Controller
                  name="quantity"
                  control={control}
                  render={({ field: { value, onChange } }) => (
                    <div className="flex items-center">
                      <Button
                        size="small"
                        variant="outlined"
                        className="min-w-0 p-1"
                        onClick={() => onChange(value - 1)}
                        disabled={value < 2 ? true : false}
                      >
                        <RemoveIcon />
                      </Button>
                      <h3 className="mx-5 text-xl">{value}</h3>
                      <Button
                        size="small"
                        variant="outlined"
                        className="min-w-0 p-1"
                        onClick={() => onChange(value + 1)}
                      >
                        <AddIcon />
                      </Button>
                    </div>
                  )}
                />
              </div>

              <Typography
                variant="h2"
                className="text-2xl font-bold mb-1 text-color-price"
              >
                258,000 US$
              </Typography>
              <div>Stock Avalable</div>
            </div>
            <Button
              type="submit"
              variant="contained"
              className="mb-9 px-7"
              size="medium"
            >
              Add to cart
            </Button>
          </form>
        </Grid>
      </Grid>
    </Container>
  );
};

export default ProductContent;
