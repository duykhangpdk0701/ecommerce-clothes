import React from "react";
// @mui
import { styled } from "@mui/material/styles";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import Container from "@mui/material/Container";
//next
import Link from "next/link";
import Image from "next/image";
//image
import img404 from "@/assets/illustrations/illustration_404.svg";

const StyledContent = styled("div")(({ theme }) => ({
  maxWidth: 480,
  margin: "auto",
  minHeight: "100vh",
  display: "flex",
  justifyContent: "center",
  flexDirection: "column",
  padding: theme.spacing(12, 0),
}));

const Custom404 = () => {
  return (
    <Container>
      <StyledContent sx={{ textAlign: "center", alignItems: "center" }}>
        <Typography variant="h3" paragraph>
          Sorry, page not found!
        </Typography>

        <Typography sx={{ color: "text.secondary" }}>
          Sorry, we couldn’t find the page you’re looking for. Perhaps you’ve
          mistyped the URL? Be sure to check your spelling.
        </Typography>
        <div className="relative">
          <Image
            src={img404.src}
            alt="logo"
            height={260}
            width={346}
            className="mx-auto my-5 sm:my-10"
          />
        </div>

        <Button href="/" size="large" variant="contained" component={Link}>
          Go to Home
        </Button>
      </StyledContent>
    </Container>
  );
};

export default Custom404;
