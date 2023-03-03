import IProduct from "@/interfaces/Product";
import { IProductDetailParmas } from "@/pages/product/[slug]";

import Button from "@mui/material/Button";
import Container from "@mui/material/Container";
import Grid from "@mui/material/Grid";
import Typography from "@mui/material/Typography";
import Rating from "@mui/material/Rating";
import RadioGroup from "@mui/material/RadioGroup";
import Radio from "@mui/material/Radio";

import CircleIcon from "@mui/icons-material/Circle";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";

import { sentenceCase } from "change-case";
import React, { useState, useRef, useEffect, FC } from "react";
import { Control } from "react-hook-form/dist/types";
import Slider from "react-slick";
import { Controller } from "react-hook-form";

interface IProductContent {
  control: Control<IProductDetailParmas, any>;
  itemDetail?: IProduct;
}

const ProductContent: FC<IProductContent> = (props) => {
  const { control, itemDetail } = props;
  const slider1Ref = useRef<Slider>();
  const slider2Ref = useRef<Slider>();
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
          <Slider
            dots
            slidesToShow={1}
            asNavFor={slider2Ref.current}
            ref={(slider) =>
              (slider1Ref.current = slider !== null ? slider : undefined)
            }
          >
            <div>
              <h3>1</h3>
            </div>
            <div>
              <h3>2</h3>
            </div>
            <div>
              <h3>3</h3>
            </div>
            <div>
              <h3>4</h3>
            </div>
            <div>
              <h3>5</h3>
            </div>
            <div>
              <h3>6</h3>
            </div>
          </Slider>
          <h4>Second Slider</h4>
          <Slider
            asNavFor={slider1Ref.current}
            ref={(slider) =>
              (slider2Ref.current = slider !== null ? slider : undefined)
            }
            slidesToShow={3}
            swipeToSlide={true}
            focusOnSelect={true}
          >
            <div>
              <h3>1</h3>
            </div>
            <div>
              <h3>2</h3>
            </div>
            <div>
              <h3>3</h3>
            </div>
            <div>
              <h3>4</h3>
            </div>
            <div>
              <h3>5</h3>
            </div>
            <div>
              <h3>6</h3>
            </div>
          </Slider>
        </Grid>

        <Grid item xs={6}>
          <form>
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
                  Option
                </Typography>
                <Controller
                  name="itemColor"
                  control={control}
                  render={({ field }) => (
                    <RadioGroup {...field} row>
                      {itemDetail?.sizes.map((item) => (
                        <Radio
                          key={item.id}
                          value={item.id}
                          icon={
                            <CircleIcon
                              sx={{ color: item.value }}
                              className="w-10 h-10 rounded-full border border-solid border-gray-300"
                            />
                          }
                          checkedIcon={
                            <CheckCircleIcon
                              sx={{ color: item.value }}
                              className="w-10 h-10 rounded-full border border-solid border-gray-300"
                            />
                          }
                        />
                      ))}
                    </RadioGroup>
                  )}
                />
              </div>

              <div className="mb-4">
                <Typography variant="h6" className="mb-2 text-sm font-semibold">
                  Option
                </Typography>
                <Controller
                  name="itemSize"
                  control={control}
                  render={({ field }) => (
                    <RadioGroup {...field} row>
                      {itemDetail?.sizes.map((item) => (
                        <Radio
                          key={item.id}
                          value={item.id}
                          icon={<Button size="small">{item.value}</Button>}
                          checkedIcon={
                            <Button variant="contained" size="small">
                              {item.value}
                            </Button>
                          }
                        />
                      ))}
                    </RadioGroup>
                  )}
                />
              </div>

              <Typography variant="h2" className="text-2xl font-bold mb-1">
                258,000US
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
