import React, { Fragment } from "react";
//mui component
import Grid from "@mui/material/Grid";
//mui component
import Container from "@mui/material/Container";
import Paper from "@mui/material/Paper";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
//mui icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";
import Link from "next/link";
import WomenFashionItem from "./item";
import Slider from "react-slick";
import { useQuery } from "react-query";
import itemAPI from "@/api/itemAPI";
import LoadingWomenItem from "./loadingItem";

const data = [<div>loading</div>];

const WomenFashion = () => {
  const listItemWomenQuery = useQuery({
    queryKey: ["item-women"],
    queryFn: () => itemAPI.getListOfItemWomen(),
  });

  return (
    <Container className="mb-16">
      {/* <Grid container spacing={3}>
        <Grid item xs={12} md={3}>
          <Paper className="px-8 py-4">
            <h3 className="text-xl">Women's fashion</h3>
            <List className="py-2 mb-4" disablePadding>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
              <ListItem disablePadding className="pt-2.5">
                Wireless Speaker
              </ListItem>
            </List>

            <Link href="/product" className="no-underline text-black">
              <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
                Browse All <ArrowForwardIcon className="text-sm" />
              </span>
            </Link>
          </Paper>
        </Grid>
        <Grid item xs={12} md={9}>
          <Slider slidesToShow={3} infinite>
            {data.map((item, index) => (
              <Fragment key={index}>{item}</Fragment>
            ))}
          </Slider>
        </Grid>
      </Grid> */}

      <div className="flex justify-between items-center mb-6">
        <h2>Women's Fashion</h2>
        <Link
          href="/product?itemPersonType=2"
          className="no-underline text-black"
        >
          <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
            Shop now <ArrowForwardIcon className="text-sm" />
          </span>
        </Link>
      </div>
      <div>
        <Slider slidesToShow={4} infinite adaptiveHeight>
          {listItemWomenQuery.isLoading
            ? Array(4).fill(<LoadingWomenItem />)
            : listItemWomenQuery.data?.map((item) => (
                <WomenFashionItem
                  key={item.id}
                  slug={item.slug}
                  name={item.name}
                  price={item.stock_lowest_price}
                  thumbnail={item.thumbnail_url}
                />
              ))}
        </Slider>
      </div>
    </Container>
  );
};

export default WomenFashion;
