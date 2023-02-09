import { TEXT_COLOR_BLACK, TEXT_COLOR_GRAY } from "@/styles/color";
import { Button, Container, Grid, Typography, Rating } from "@mui/material";
import React, { useState, useRef, useEffect } from "react";
import Slider from "react-slick";

const ProductContent = () => {
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
          <Typography variant="h1" className="text-3xl font-bold mb-2">
            Say Ban Matt Black
          </Typography>
          <div className="flex mb-2 items-baseline">
            <div className="text-sm" style={{ color: TEXT_COLOR_GRAY }}>
              Brand:
            </div>
            <h6 className="text-sm font-medium">Xiaomi</h6>
          </div>
          <div className="flex mb-2 items-center">
            <div className="text-sm" style={{ color: TEXT_COLOR_GRAY }}>
              Rate:
            </div>
            <Rating
              size="small"
              name="read-only"
              className="mx-1"
              value={5}
              readOnly
            />
          </div>
          <div className="pt-2 mb-6">
            <Typography variant="h2" className="text-2xl font-bold mb-1">
              258,000US
            </Typography>
            <div>Stock Avalable</div>
            <div className="mb-6">
              <h6>Option</h6>
            </div>
          </div>
          <Button variant="contained" className="mb-9 px-7" size="medium">
            Add to cart
          </Button>
        </Grid>
      </Grid>
    </Container>
  );
};

export default ProductContent;
