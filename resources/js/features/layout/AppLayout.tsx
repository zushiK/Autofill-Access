type AppLayoutType = {
  children: React.ReactNode;
};

export default function AppLayout(props: AppLayoutType) {
  return (
    <>
      <header className="sticky top-0">THIS IS HEADER</header>
      <main>
        <div className="container mx-auto">
          <div className="flex-grow">{props.children}</div>
        </div>
      </main>
      <header>THIS IS HEADER</header>
    </>
  );
}
